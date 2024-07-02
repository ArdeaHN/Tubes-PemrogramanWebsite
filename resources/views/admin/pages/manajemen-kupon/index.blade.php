@extends('admin.layouts.app')

@push('customCss')
    <!-- Datatable Css -->
    <link href="{{ asset('assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/libs/bootstrap-switch-button/css/bootstrap-switch-button.min.css') }}" rel="stylesheet">
@endpush

@push('customJs')
    <script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap-switch-button/dist/bootstrap-switch-button.min.js') }}"></script>

    <script type="text/javascript">
        new DataTable('#datatable');

        $('input[name=toggle]').change(function() {
            let mode = $(this).prop('checked');
            let id = $(this).val();
            $.ajax({
                url: "{{ route('coupon.status.update') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    mode: mode,
                    id: id
                },
                success: function(response) {
                    console.log(response.status);
                }
            });
        });
    </script>
@endpush
@section('content')
    <div class="row">
        <!-- Page Header -->
        <div class="col-lg-12 col-md-12 col-12">
            <div class="border-bottom pb-3 mb-3 d-md-flex align-items-center justify-content-between">
                <div class="mb-3 mb-md-0">
                    <h1 class="mb-1 h2 fw-bold">Data Kupon</h1>
                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Kupon</li>
                        </ol>
                    </nav>
                </div>
                <div>
                    <a href="{{ route('coupon.create') }}" class="btn btn-primary">Tambah
                        Kupon</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12 text-break">
            @include('generals._validation')
        </div>
        <div class="col-lg-12 col-md-12 col-12">
            <div class="card mb-4">
                <div class="table-responsive border-0 overflow-y-hidden">
                    <table class="table mb-0 text-nowrap table-centered table-hover" id="datatable" style="width: 100%">
                        <thead class="table-light">
                            <tr>
                                <th>
                                    #
                                </th>
                                <th>KODE</th>
                                <th>TIPE</th>
                                <th>JUMLAH KLAIM PER USER</th>
                                <th>TOTAL</th>
                                <th>NILAI</th>
                                <th>STATUS</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($coupons as $coupon)
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>
                                        {{ $coupon->code }}
                                    </td>
                                    <td>
                                        {{ $coupon->type }}
                                    </td>
                                    <td class="text-center">
                                        {{ $coupon->max_uses_user }}
                                    </td>
                                    <td class="text-center">
                                        {{ $coupon->max_uses }}
                                    </td>
                                    <td>
                                        {{ $coupon->value }}
                                    </td>
                                    <td>
                                        <input value="{{ $coupon->id }}" type="checkbox" data-toggle="switchbutton"
                                            {{ $coupon->status == 'active' ? 'checked' : '' }} data-onlabel="Aktif"
                                            data-offlabel="Tidak-aktif" data-onstyle="success" data-offstyle="danger"
                                            data-size="xs" name="toggle">
                                    </td>
                                    <td>
                                        <span class="dropdown dropstart">
                                            <a class="btn-icon btn btn-ghost btn-sm rounded-circle" href="#"
                                                role="button" id="courseDropdown3" data-bs-toggle="dropdown"
                                                data-bs-offset="-20,20" aria-expanded="false">
                                                <i class="fe fe-more-vertical"></i>
                                            </a>
                                            <span class="dropdown-menu" aria-labelledby="courseDropdown3">
                                                <span class="dropdown-header">Action</span>
                                                <a class="dropdown-item" href="{{ route('coupon.edit', $coupon->id) }}"
                                                    data-route-update="{{ route('coupon.update', $coupon) }}"
                                                    id="editCoupon"><i class="fe fe-edit dropdown-item-icon"></i>Edit</a>
                                                <a class="dropdown-item" href="{{ route('coupon.show', $coupon) }}"><i
                                                        class="fe fe-info dropdown-item-icon"></i>Detail</a>

                                                <a href="{{ route('coupon.destroy', $coupon) }}" class="dropdown-item"
                                                    data-confirm-delete="true"><i
                                                        class="fe fe-trash dropdown-item-icon"></i>Hapus</a>
                                            </span>
                                        </span>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
