<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\PaymentService;
use App\Models\Payment;
use App\Models\Installment;
use App\Models\TbClass;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SppInvoiceMail;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;


class PaymentController extends Controller
{

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }




    /**
     * List semua pembayaran
     */
    public function index(Request $request)
    {
        $classes = TbClass::all();
        $payments = Payment::with(['user.class', 'installment.user.class'])

            // 🔍 Search
            ->when($request->filled('search'), function ($q) use ($request) {
                $search = $request->search;
                $q->where(function ($sub) use ($search) {
                    $sub->whereHas('user', function ($sq) use ($search) {
                        $sq->where('name', 'like', "%{$search}%");
                    })->orWhereHas('installment.user', function ($sq) use ($search) {
                        $sq->where('name', 'like', "%{$search}%");
                    })->orWhere('code', 'like', "%{$search}%");
                });
            })

            // 📌 Filter jenis pembayaran (spp / register)
            ->when($request->filled('payment_for'), function ($q) use ($request) {
                $q->where('payment_for', $request->payment_for);
            })

            // 📌 Filter status (pending / paid / failed)
            ->when($request->filled('status'), function ($q) use ($request) {
                $q->where('status', $request->status);
            })

            // 📌 Filter kategori (lunas / cicilan)
            ->when($request->filled('payment_category'), function ($q) use ($request) {
                $q->where('payment_category', $request->payment_category);
            })

            ->when($request->filled('class_id'), function ($q) use ($request) {
                $q->whereHas('user.class', function ($sub) use ($request) {
                    $sub->where('id', $request->class_id);
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(25)
            ->appends($request->query());

        return view('admin.payment.index', compact('payments', 'classes'));
    }


    // public function update(Request $request, $id)
    // {
    //     $payment = Payment::findOrFail($id);

    //     $request->validate([
    //         'amount' => 'required|numeric|min:0',
    //         'due_date' => 'nullable|date',
    //         'status' => 'required|in:pending,paid,failed',
    //     ]);

    //     $payment->update($request->only(['amount', 'due_date', 'status']));

    //     // jika status paid → update paid_at
    //     if ($payment->status === 'paid' && !$payment->paid_at) {
    //         $payment->paid_at = now();
    //         $payment->save();
    //     }

    //     return back()->with('success', 'Data cicilan berhasil diperbarui');
    // }

    /**
     * Update status cicilan (child payment).
     */
    // public function updatePaymentStatus(Request $request, $id)
    // {
    //     $validated = $request->validate([
    //         'status' => 'required|in:pending,paid,overdue,failed'
    //     ]);

    //     $payment = Payment::findOrFail($id);
    //     $payment->status  = $validated['status'];
    //     $payment->paid_at = $validated['status'] === 'paid' ? now() : null;
    //     $payment->save();

    //     return back()->with('success', 'Status cicilan berhasil diperbarui.');
    // }


    /**
     * Update due date cicilan (child payment).
     */
public function updatePaymentDueDate(Request $request, $id)
{
    $validated = $request->validate([
        'due_date' => 'required|date'
    ]);

    $payment = Payment::findOrFail($id);
    $payment->update([
        'due_date' => $validated['due_date'],
    ]);

    return back()->with('success', 'Jatuh tempo cicilan berhasil diperbarui.');
}


    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,paid,failed,overdue',
        ]);

        $payment = Payment::findOrFail($id);

        // ✅ serahkan ke service
        $this->paymentService->updatePaymentStatus($payment, $validated['status']);

        return redirect()->route('admin.payment.index')
            ->with('success', 'Status pembayaran berhasil diperbarui.');
    }


    /**
     * Detail installment + semua cicilan.
     */
    public function show($id)
    {
        // Ambil payment dulu
        $payment = Payment::with(['user.class', 'installment.payments'])->findOrFail($id);

        return view('admin.payment.show', compact('payment'));
    }
    




    /**
     * Form generate SPP
     */
    public function showGenerateSppForm()
    {
        $classes = TbClass::all();
        return view('admin.payment.generateSPP', compact('classes'));
    }

    /**
     * Generate SPP untuk siswa
     */
    public function generateSPP(Request $request)
    {
        $request->validate([
            'month'    => 'required|string',
            'year'     => 'required|digits:4',
            'class_id' => 'nullable|integer',
            'amount'   => 'nullable|numeric',
        ]);

        $month   = $request->month;
        $year    = $request->year;
        $classId = $request->class_id;
        $amount  = $request->amount ?? 50000; // default

        $studentsQuery = User::where('role_id', 2);
        if ($classId) {
            $studentsQuery->where('class_id', $classId);
        }
        $students = $studentsQuery->get();

        $created = 0;
        foreach ($students as $student) {
            $exists = Payment::where('user_id', $student->id)
                ->where('payment_for', 'spp')
                ->where('month', $month)
                ->where('year', $year)
                ->exists();

            if ($exists) continue;

            DB::beginTransaction();
            try {
                $payment = Payment::create([
                    'user_id'          => $student->id,
                    'class_id'         => $student->class_id,
                    'payment_for'      => 'spp',
                    'payment_category' => 'lunas',
                    'payment_type'     => 'non-tunai',
                    'method'           => 'qris',
                    'code'             => 'SPP-' . strtoupper(uniqid()),
                    'amount'           => $amount,
                    'month'            => $month,
                    'year'             => $year,
                    'status'           => 'pending',
                ]);

                Mail::to($student->email)->send(new SppInvoiceMail($payment));

                DB::commit();
                $created++;
            } catch (Exception $e) {
                DB::rollBack();
                Log::error("Generate SPP failed for user {$student->id}: " . $e->getMessage());
            }
        }

        return back()->with('success', "Generate selesai. Tagihan dibuat untuk {$created} siswa.");
    }

    /**
     * Kirim ulang email tagihan
     */
    public function sendSppInvoices($month, $year)
    {
        $payments = Payment::where('payment_for', 'spp')
            ->where('month', $month)
            ->where('year', $year)
            ->get();

        foreach ($payments as $payment) {
            try {
                Mail::to($payment->user->email)->send(new SppInvoiceMail($payment));
                Log::info("Email tagihan SPP terkirim ke {$payment->user->email}");
            } catch (\Exception $e) {
                Log::error("Gagal kirim email ke {$payment->user->email}: " . $e->getMessage());
            }
        }

        return back()->with('success', 'Email tagihan berhasil dikirim.');
    }

    /**
     * Ambil data kelas siswa
     */
    public function getStudentClass($id)
    {
        $student = User::with('class')->where('role_id', 2)->findOrFail($id);

        return response()->json([
            'class_id'   => $student->class_id,
            'class_name' => $student->class->class_name ?? '-'
        ]);
    }

    /**
     * Form create pembayaran
     */
    public function create()
    {
        $students = User::where('role_id', 2)->get();
        $classes  = TbClass::all();
        $installments = Installment::with('user')->get();

        return view('admin.payment.create', compact('students', 'classes', 'installments'));
    }

    /**
     * Store pembayaran baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id'          => 'required|exists:users,id',
            'class_id'         => 'required|exists:classes,id',
            'payment_for'      => 'required|in:register,spp',
            'payment_category' => 'required|in:lunas,cicilan',
            'total_amount'     => 'required|numeric|min:0',
            'jumlah_cicilan'   => 'nullable|integer|min:1', // hanya kalau cicilan
        ]);

        if ($validated['payment_category'] === 'lunas') {
            // 🚀 Simpan langsung 1 record lunas
            Payment::create([
                'user_id'          => $validated['user_id'],
                'class_id'         => $validated['class_id'],
                'payment_for'      => $validated['payment_for'],
                'payment_category' => 'lunas',
                'amount'           => $validated['total_amount'],
                'status'           => 'paid',
                'paid_at'          => now(),
            ]);
        } else {
            // 🚀 Buat record installment (parent)
            $installment = Installment::create([
                'user_id'   => $validated['user_id'],
                'class_id'  => $validated['class_id'],
                'total'     => $validated['total_amount'],
                'status'    => 'pending',
            ]);

            // hitung nominal per cicilan
            $jumlahCicilan  = $validated['jumlah_cicilan'] ?? 3;
            $nominalCicilan = $validated['total_amount'] / $jumlahCicilan;
            $startDate      = now();

            // 🚀 Generate child cicilan (tb_payments)
            for ($i = 1; $i <= $jumlahCicilan; $i++) {
                Payment::create([
                    'installment_id'   => $installment->id,
                    'user_id'          => $validated['user_id'],
                    'class_id'         => $validated['class_id'],
                    'payment_for'      => $validated['payment_for'],
                    'payment_category' => 'cicilan',
                    'amount'           => $nominalCicilan,
                    'status'           => 'pending',
                    'due_date'         => $startDate->copy()->addMonths($i - 1),
                ]);
            }
        }

        return redirect()->route('admin.payment.index')
            ->with('success', 'Data pembayaran berhasil ditambahkan.');
    }



    /**
     * Detail pembayaran
     */
    // public function show($id)
    // {
    //     $payment = Payment::with('installment.user', 'installment.class')->findOrFail($id);
    //     return view('admin.payment.show', compact('payment'));
    // }

    /**
     * Form edit pembayaran
     */
    public function edit($id)
    {
        $payment      = Payment::findOrFail($id);
        $students     = User::where('role_id', 2)->get();
        $classes      = TbClass::all();
        $installments = Installment::with('user')->get();

        return view('admin.payment.edit', compact('payment', 'students', 'classes', 'installments'));
    }

    /**
     * Update pembayaran
     */
    protected $paymentService;



    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'installment_id'   => 'nullable|exists:tb_installment,id',
            'user_id'          => 'required|exists:users,id',
            'class_id'         => 'required|exists:tb_class,id',
            'payment_type'     => 'required|string|max:255',
            'payment_category' => 'required|string|max:255',
            'amount'           => 'required|numeric',
            'method'           => 'required|string|max:50',
            'month'            => 'nullable|string|max:50',
            'status'           => 'required|in:pending,paid,canceled',
            'paid_at'          => 'nullable|date',
            'due_date'         => 'nullable|date',
        ]);

        if ($request->filled('paid_at')) {
            $validated['paid_at'] = date('Y-m-d H:i:s', strtotime($request->paid_at));
        }

        $payment = Payment::findOrFail($id);
        $payment->update($validated);

        if ($payment->installment_id) {
            $this->paymentService->updateInstallmentStatus($payment->installment_id);
        }

        return redirect()->route('admin.payment.index')
            ->with('success', 'Data pembayaran berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $payment = Payment::findOrFail($id);
        $installmentId = $payment->installment_id;

        $payment->delete();

        if ($installmentId) {
            $this->paymentService->updateInstallmentStatus($installmentId);
        }

        return redirect()->route('admin.payment.index')
            ->with('success', 'Data pembayaran berhasil dihapus.');
    }

    /**
     * Helper untuk update status installment
     */



    public function export(Request $request)
    {
        $query = Payment::with(['user.class', 'installment.user.class'])
            // 🔍 Search
            ->when($request->filled('search'), function ($q) use ($request) {
                $search = $request->search;
                $q->where(function ($sub) use ($search) {
                    $sub->whereHas('user', function ($sq) use ($search) {
                        $sq->where('name', 'like', "%{$search}%");
                    })->orWhereHas('installment.user', function ($sq) use ($search) {
                        $sq->where('name', 'like', "%{$search}%");
                    })->orWhere('code', 'like', "%{$search}%");
                });
            })

            // 📌 Filter jenis pembayaran (spp / register)
            ->when($request->filled('payment_for'), function ($q) use ($request) {
                $q->where('payment_for', $request->payment_for);
            })

            // 📌 Filter status
            ->when($request->filled('status'), function ($q) use ($request) {
                $q->where('status', $request->status);
            })

            // 📌 Filter kategori
            ->when($request->filled('payment_category'), function ($q) use ($request) {
                $q->where('payment_category', $request->payment_category);
            })

            ->when($request->filled('class_id'), function ($q) use ($request) {
                $q->whereHas('user.class', function ($sub) use ($request) {
                    $sub->where('id', $request->class_id);
                });
            });



        $payments = $query->orderBy('created_at', 'desc')->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Judul
        $sheet->mergeCells('A1:J1');
        $sheet->setCellValue('A1', 'LAPORAN PEMBAYARAN');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Header tabel
        $headers = [
            'No',
            'Kode Pembayaran',
            'Nama Siswa',
            'Kelas',
            'Jenis',
            'Kategori',
            'Nominal Tagihan',   // dari installment
            'Jumlah Dibayar',    // dari payments
            'Status',
            'Tanggal Bayar'
        ];
        $sheet->fromArray($headers, null, 'A3');

        $sheet->getStyle('A3:J3')->getFont()->setBold(true);
        $sheet->getStyle('A3:J3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A3:J3')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

        // Data
        $row = 4;
        $no = 1;
        $totalNominal = 0;
        $totalAmount = 0;

        foreach ($payments as $p) {
            $nama = optional(optional($p->installment)->user)->name ?? optional($p->user)->name ?? '-';
            $kelas = optional(optional(optional($p->installment)->user)->class)->class_name
                ?? optional(optional($p->user)->class)->class_name ?? '-';

            $jenis = $p->payment_for === 'spp' ? 'SPP' : 'Register';
            $kategori = $p->payment_category === 'lunas' ? 'Lunas' : 'Cicilan';

            // Nominal tagihan dari installment
            $nominal = $p->installment->nominal ?? 0;

            // Jumlah yang dibayar dari payments
            $amount = $p->amount ?? 0;

            $status = match ($p->status) {
                'paid' => 'Lunas',
                'pending' => 'Menunggu',
                'failed' => 'Batal',
                default => ucfirst($p->status)
            };

            $tanggal = $p->paid_at ? $p->paid_at->format('d/m/Y') : '-';

            $sheet->fromArray([
                $no++,
                $p->code,
                $nama,
                $kelas,
                $jenis,
                $kategori,
                $nominal,
                $amount,
                $status,
                $tanggal
            ], null, 'A' . $row);

            $sheet->getStyle("A{$row}:J{$row}")
                ->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

            // akumulasi total
            $totalNominal += $nominal;
            $totalAmount += $amount;

            $row++;
        }

        // Tambah baris total
        $sheet->setCellValue("F{$row}", "TOTAL");
        $sheet->setCellValue("G{$row}", $totalNominal);
        $sheet->setCellValue("H{$row}", $totalAmount);

        $sheet->getStyle("F{$row}:H{$row}")->getFont()->setBold(true);
        $sheet->getStyle("F{$row}:H{$row}")->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

        // Format angka ke Rupiah
        $sheet->getStyle('G4:G' . $row)
            ->getNumberFormat()->setFormatCode('"Rp" #,##0');
        $sheet->getStyle('H4:H' . $row)
            ->getNumberFormat()->setFormatCode('"Rp" #,##0');

        // Auto-size kolom
        foreach (range('A', 'J') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Buat file download
        $writer = new Xlsx($spreadsheet);
        $filename = 'laporan_pembayaran.xlsx';

        return response()->streamDownload(function () use ($writer) {
            $writer->save('php://output');
        }, $filename);
    }
}
