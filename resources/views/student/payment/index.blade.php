@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Bayar SPP</h4>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Bulan</th>
                <th>Jumlah</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Juli 2025</td>
                <td>Rp50.000</td>
                <td><span class="badge bg-warning">Belum ada transaksi</span></td>
                <td>
                    <form action="{{ route('student.payment.spp.pay', 'Juli-2025') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-sm">Bayar</button>
                    </form>
                </td>
            </tr>
            <tr>
                <td>2</td>
                <td>Agustus 2025</td>
                <td>Rp50.000</td>
                <td><span class="badge bg-warning">Belum ada transaksi</span></td>
                <td>
                    <form action="{{ route('student.payment.spp.pay', 'Agustus-2025') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-sm">Bayar</button>
                    </form>
                </td>
            </tr>
            <tr>
                <td>3</td>
                <td>September 2025</td>
                <td>Rp50.000</td>
                <td><span class="badge bg-warning">Belum ada transaksi</span></td>
                <td>
                    <form action="{{ route('student.payment.spp.pay', 'September-2025') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-sm">Bayar</button>
                    </form>
                </td>
            </tr>
            <tr>
                <td>4</td>
                <td>Oktober 2025</td>
                <td>Rp50.000</td>
                <td><span class="badge bg-warning">Belum ada transaksi</span></td>
                <td>
                    <form action="{{ route('student.payment.spp.pay', 'Oktober-2025') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-sm">Bayar</button>
                    </form>
                </td>
            </tr>
            <tr>
                <td>5</td>
                <td>November 2025</td>
                <td>Rp50.000</td>
                <td><span class="badge bg-warning">Belum ada transaksi</span></td>
                <td>
                    <form action="{{ route('student.payment.spp.pay', 'November-2025') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-sm">Bayar</button>
                    </form>
                </td>
            </tr>
            <tr>
                <td>6</td>
                <td>Desember 2025</td>
                <td>Rp50.000</td>
                <td><span class="badge bg-warning">Belum ada transaksi</span></td>
                <td>
                    <form action="{{ route('student.payment.spp.pay', 'Desember-2025') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-sm">Bayar</button>
                    </form>
                </td>
            </tr>
            <tr>
                <td>7</td>
                <td>Januari 2026</td>
                <td>Rp50.000</td>
                <td><span class="badge bg-warning">Belum ada transaksi</span></td>
                <td>
                    <form action="{{ route('student.payment.spp.pay', 'Januari-2026') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-sm">Bayar</button>
                    </form>
                </td>
            </tr>
            <tr>
                <td>8</td>
                <td>Februari 2026</td>
                <td>Rp50.000</td>
                <td><span class="badge bg-warning">Belum ada transaksi</span></td>
                <td>
                    <form action="{{ route('student.payment.spp.pay', 'Februari-2026') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-sm">Bayar</button>
                    </form>
                </td>
            </tr>
            <tr>
                <td>9</td>
                <td>Maret 2026</td>
                <td>Rp50.000</td>
                <td><span class="badge bg-warning">Belum ada transaksi</span></td>
                <td>
                    <form action="{{ route('student.payment.spp.pay', 'Maret-2026') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-sm">Bayar</button>
                    </form>
                </td>
            </tr>
            <tr>
                <td>10</td>
                <td>April 2026</td>
                <td>Rp50.000</td>
                <td><span class="badge bg-warning">Belum ada transaksi</span></td>
                <td>
                    <form action="{{ route('student.payment.spp.pay', 'April-2026') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-sm">Bayar</button>
                    </form>
                </td>
            </tr>
            <tr>
                <td>11</td>
                <td>Mei 2026</td>
                <td>Rp50.000</td>
                <td><span class="badge bg-warning">Belum ada transaksi</span></td>
                <td>
                    <form action="{{ route('student.payment.spp.pay', 'Mei-2026') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-sm">Bayar</button>
                    </form>
                </td>
            </tr>
            <tr>
                <td>12</td>
                <td>Juni 2026</td>
                <td>Rp50.000</td>
                <td><span class="badge bg-warning">Belum ada transaksi</span></td>
                <td>
                    <form action="{{ route('student.payment.spp.pay', 'Juni-2026') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-sm">Bayar</button>
                    </form>
                </td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
