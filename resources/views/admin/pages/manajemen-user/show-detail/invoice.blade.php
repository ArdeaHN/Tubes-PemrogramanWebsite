@extends('admin.pages.manajemen-user.show-detail.index')

@section('card')
    <!-- Card -->
    <div class="card mb-4">
        <!-- Card header -->
        <div class="card-header border-bottom-0">
            <h3 class="mb-0">Invoices</h3>
            <p class="mb-0">You can find all of your order Invoices.</p>
        </div>
        <!-- Table -->
        <div class="table-invoice table-responsive">
            <table class="table mb-0 text-nowrap table-centered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Order ID</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><a href="invoice-details.html">#1008</a></td>
                        <td>17 April 2020, 10:45pm</td>
                        <td>$39.00</td>
                        <td><span class="badge bg-danger">Due</span></td>
                        <td>
                            <a href="../assets/images/pdf/invoiceFile.pdf" class="fe fe-download" download></a>
                        </td>
                    </tr>
                    <tr>
                        <td><a href="invoice-details.html">#1007</a></td>
                        <td>17 April 2020, 10:45pm</td>
                        <td>$39.00</td>
                        <td>
                            <span class="badge bg-success">Complete</span>
                        </td>
                        <td>
                            <a href="../assets/images/pdf/invoiceFile.pdf" class="fe fe-download" download></a>
                        </td>
                    </tr>
                    <tr>
                        <td><a href="invoice-details.html">#1006</a></td>
                        <td>17 Feb 2020, 10:45pm</td>
                        <td>$39.00</td>
                        <td>
                            <span class="badge bg-success">Complete</span>
                        </td>
                        <td>
                            <a href="../assets/images/pdf/invoiceFile.pdf" class="fe fe-download" download></a>
                        </td>
                    </tr>
                    <tr>
                        <td><a href="invoice-details.html">#1005</a></td>
                        <td>17 January 2020, 10:45pm</td>
                        <td>$39.00</td>
                        <td>
                            <span class="badge bg-success">Complete</span>
                        </td>
                        <td>
                            <a href="../assets/images/pdf/invoiceFile.pdf" class="fe fe-download" download></a>
                        </td>
                    </tr>
                    <tr>
                        <td><a href="invoice-details.html">#1004</a></td>
                        <td>17 Dec 2019, 10:45pm</td>
                        <td>$39.00</td>
                        <td>
                            <span class="badge bg-success">Complete</span>
                        </td>
                        <td>
                            <a href="../assets/images/pdf/invoiceFile.pdf" class="fe fe-download" download></a>
                        </td>
                    </tr>
                    <tr>
                        <td><a href="invoice-details.html">#1003</a></td>
                        <td>17 Nov 2019, 10:45pm</td>
                        <td>$39.00</td>
                        <td>
                            <span class="badge bg-success">Complete</span>
                        </td>
                        <td>
                            <a href="../assets/images/pdf/invoiceFile.pdf" class="fe fe-download" download></a>
                        </td>
                    </tr>
                    <tr>
                        <td><a href="invoice-details.html">#1002</a></td>
                        <td>17 Oct 2019, 10:45pm</td>
                        <td>$39.00</td>
                        <td>
                            <span class="badge bg-success">Complete</span>
                        </td>
                        <td>
                            <a href="../assets/images/pdf/invoiceFile.pdf" class="fe fe-download" download></a>
                        </td>
                    </tr>
                    <tr>
                        <td><a href="invoice-details.html">#1001</a></td>
                        <td>17 Sept 2019, 10:45pm</td>
                        <td>$39.00</td>
                        <td>
                            <span class="badge bg-success">Complete</span>
                        </td>
                        <td>
                            <a href="../assets/images/pdf/invoiceFile.pdf" class="fe fe-download" download></a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
