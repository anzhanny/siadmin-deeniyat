@extends('layouts.layout')
@section('content')
<style>
  table {
    border-collapse: collapse;
    width: 90%;
  }

  th, td, tr {
    border: 1px solid rgb(139, 157, 174);
    padding: 8px;
    text-align: center;
    font-size: 14px;
  }

  thead {
    background-color:rgb(208, 223, 253)
    ;
  }

  th, tfoot, .no-raport, .td-pelajaran {
    font-weight: bold;
    text-transform: uppercase;
    color:rgb(63, 69, 74);
  }
</style>

      <div class="row">
        <div class="col-12">
          
          <div class="card mb-4">
          
            <div class="card-header pb-0">
              <div class="d-flex justify-content-between mb-0">
                  <button class="btn btn-success">
                    <i class="ni ni-cloud-download-95"></i> Download File
                  </button>
              </div>
              <h6>Daftar Nilai Raport</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-3">
              <table class="table align-items-center mb-3">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Pelajaran</th>
                    <th>Sub Materi</th>
                    <th>Rata-rata</th>
                    <th>Nilai Akhir</th>
                  </tr>
                </thead>
                <tbody>
                  <!-- Al-Quran -->
                  <tr>
                    <td  class="no-raport" rowspan="2">1</td>
                    <td class="td-pelajaran" rowspan="2" >Al-Quran</td>
                    <td>Qaidah Nuraniyah</td>
                    <td>70</td>
                    <td>85</td>
                  </tr>
                  <tr>
                    <td>Hapalan Surat</td>
                    <td>80</td>
                    <td>90</td>
                  </tr>

                  <!-- Hadits -->
                  <tr>
                    <td  class="no-raport" rowspan="2">2</td>
                    <td  class="td-pelajaran" rowspan="2">Hadits</td>
                    <td>Doa Sunnah</td>
                    <td>75</td>
                    <td>88</td>
                  </tr>
                  <tr>
                    <td>Hapalan Hadits</td>
                    <td>78</td>
                    <td>87</td>
                  </tr>

                  <!-- Aqidah Fiqih -->
                  <tr>
                    <td  class="no-raport" rowspan="4">3</td>
                    <td  class="td-pelajaran" rowspan="4">Aqidah Fiqih</td>
                    <td>Aqidah</td>
                    <td>72</td>
                    <td>84</td>
                  </tr>
                  <tr>
                    <td>Shalat</td>
                    <td>76</td>
                    <td>86</td>
                  </tr>
                  <tr>
                    <td>Asmaul Husna</td>
                    <td>80</td>
                    <td>89</td>
                  </tr>
                  <tr>
                    <td>Fiqh</td>
                    <td>79</td>
                    <td>85</td>
                  </tr>

                  <!-- Pendidikan Islam -->
                  <tr>
                    <td  class="no-raport" rowspan="4">4</td>
                    <td  class="td-pelajaran" rowspan="4">Pendidikan Islam</td>
                    <td>Pengetahuan Islam</td>
                    <td>88</td>
                    <td>90</td>
                  </tr>
                  <tr>
                    <td>Pidato dan Doa</td>
                    <td>90</td>
                    <td>92</td>
                  </tr>
                  <tr>
                    <td>Sirah</td>
                    <td>85</td>
                    <td>88</td>
                  </tr>
                  <tr>
                    <td>Agama yang Mudah</td>
                    <td>86</td>
                    <td>87</td>
                  </tr>

                  <!-- Bahasa -->
                  <tr>
                    <td class="no-raport" >5</td>
                    <td  class="td-pelajaran" >Bahasa</td>
                    <td>Bahasa Arab</td>
                    <td>84</td>
                    <td>91</td>
                  </tr>

                  <!-- Muatan Lokal -->
                  <tr>
                <td  class="no-raport" rowspan="2">6</td>
                <td  class="td-pelajaran" rowspan="2">Muatan Lokal</td>
                <td>Aqidatul Awwam</td>
                <td>85</td>
                <td>89</td>
              </tr>
              <tr >
                <td>Tuhfatul Athfal</td>
                <td>88</td>
                <td>90</td>
              </tr>
              <tr></tr>


                </tbody>
                <tfoot>
                  <tr>
                    <td colspan="4">TOTAL</td>
                    <td>87.4</td>
                  </tr>
                </tfoot>
              </table>


              </div>
            </div>
          </div>
        </div>
      </div>
      @endsection