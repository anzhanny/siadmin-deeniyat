@extends('layouts.layout')
@section('content')
      <div class="row">
        <div class="col-12">
          
          <div class="card mb-4">
          
            <div class="card-header pb-0">
              <div class="d-flex justify-content-between mb-0">
                   <!-- tambah data -->
              <a href="{{ route('studentdata.create') }}">
                <button class="btn btn-primary">
                  <i class="ni ni-fat-add"></i> Tambah Data
                </button>
              </a>
                  <button class="btn btn-success">
                    <i class="ni ni-cloud-download-95"></i> Download File
                  </button>
              </div>
              <h6>Student Data</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NIS</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Name</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Phone</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Gender</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ">Birthdate</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Class</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Father Name</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ">Mother Name</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ">Photo</th>
                      <th class="text-secondary text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                        <td class="align-middle text-right text-sm">10234567</td>
                        <td>
                            <div class="d-flex px-2 py-1">
                                <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0 text-sm">Muhammad Ali</h6>
                                    <p class="text-xs text-secondary mb-0">ali@example.com</p>
                                </div>
                            </div>
                        </td>
                        <td class="align-middle text-center text-sm">08123456789</td>
                        <td class="align-middle text-center text-sm">L</td>
                        <td class="align-middle text-center text-sm">2005-06-12</td>
                        <td class="align-middle text-center text-sm">1A</td>
                        <td class="align-middle text-center text-sm">
                            <span class="badge badge-sm bg-gradient-success">Active</span>
                        </td>
                        <td class="align-middle text-center text-sm">Ahmad</td>
                        <td class="align-middle text-center text-sm">Aisyah</td>
                        <td class="align-middle text-center text-sm">
                        <img src="../assets/img/team-2.jpg" class="avatar avatar-sm me-3" alt="user2">

                        </td>
<td class="align-middle">
                        <button type="button" class="btn btn-primary btn-icon btn-sm p-1" style="width: 30px; height: 30px;" title="Edit Kelas">
                          <a href="javascript:;" class="text-white font-weight-bold text-xs">
                            <i class="fa fa-edit pt-1" aria-hidden="true"></i>
                          </a>
                        </button>
                        <button type="button" class="btn btn-danger btn-icon btn-sm p-1" style="width: 30px; height: 30px;" title="Hapus Kelas">
                          <a href="javascript:;" class="text-white font-weight-bold text-xs">
                            <i class="fa fa-trash pt-1" aria-hidden="true"></i>
                          </a>
                        </button>
                      </td>
                    </tr>

                    <tr>
                        <td class="align-middle text-center text-sm">10234568</td>
                        <td>
                            <div class="d-flex px-2 py-1">
                               
                                <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0 text-sm">Nazwa Putri</h6>
                                    <p class="text-xs text-secondary mb-0">nazwaputri@example.com</p>
                                </div>
                            </div>
                        </td>
                        <td class="align-middle text-center text-sm">08129876543</td>
                        <td class="align-middle text-center text-sm">P</td>
                        <td class="align-middle text-center text-sm">2006-03-25</td>
                        <td class="align-middle text-center text-sm">2B</td>
                        <td class="align-middle text-center text-sm">
                            <span class="badge badge-sm bg-gradient-warning">Inactive</span>
                        </td>
                        <td class="align-middle text-center text-sm">Fauzan</td>
                        <td class="align-middle text-center text-sm">Nadia</td>
                        <td class="align-middle text-center text-sm">
                        <img src="../assets/img/team-1.jpg" class="avatar avatar-sm me-3" alt="user1">
                        </td>
<td class="align-middle">
                        <button type="button" class="btn btn-primary btn-icon btn-sm p-1" style="width: 30px; height: 30px;" title="Edit Kelas">
                          <a href="javascript:;" class="text-white font-weight-bold text-xs">
                            <i class="fa fa-edit pt-1" aria-hidden="true"></i>
                          </a>
                        </button>
                        <button type="button" class="btn btn-danger btn-icon btn-sm p-1" style="width: 30px; height: 30px;" title="Hapus Kelas">
                          <a href="javascript:;" class="text-white font-weight-bold text-xs">
                            <i class="fa fa-trash pt-1" aria-hidden="true"></i>
                          </a>
                        </button>
                      </td>
                    </tr>

                    <tr>
                        <td class="align-middle text-center text-sm">10234569</td>
                        <td>
                            <div class="d-flex px-2 py-1">
                                
                                <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0 text-sm">Budi Santoso</h6>
                                    <p class="text-xs text-secondary mb-0">budi@example.com</p>
                                </div>
                            </div>
                        </td>
                        <td class="align-middle text-center text-sm">08134567890</td>
                        <td class="align-middle text-center text-sm">L</td>
                        <td class="align-middle text-center text-sm">2004-11-08</td>
                        <td class="align-middle text-center text-sm">3C</td>
                        <td class="align-middle text-center text-sm">
                            <span class="badge badge-sm bg-gradient-success">Active</span>
                        </td>
                        <td class="align-middle text-center text-sm">Wahyu</td>
                        <td class="align-middle text-center text-sm">Sri</td>
                        <td class="align-middle text-center text-sm">
                            <img src="../assets/img/team-3.jpg" class="avatar avatar-sm me-3" alt="user3">
                        </td>
<td class="align-middle">
                        <button type="button" class="btn btn-primary btn-icon btn-sm p-1" style="width: 30px; height: 30px;" title="Edit Kelas">
                          <a href="javascript:;" class="text-white font-weight-bold text-xs">
                            <i class="fa fa-edit pt-1" aria-hidden="true"></i>
                          </a>
                        </button>
                        <button type="button" class="btn btn-danger btn-icon btn-sm p-1" style="width: 30px; height: 30px;" title="Hapus Kelas">
                          <a href="javascript:;" class="text-white font-weight-bold text-xs">
                            <i class="fa fa-trash pt-1" aria-hidden="true"></i>
                          </a>
                        </button>
                      </td>
                    </tr>
                </tbody>

                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      @endsection