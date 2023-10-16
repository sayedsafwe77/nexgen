<x-layout :title="$qutation->name" :breadcrumbs="['dashboard.qutations.show', $qutation]">
    @push('styles')
        <style>
            .qutation,
            .qutation tr,
            .qutation td,
            .qutation th {
                border: 2px solid black;
            }

            .qutation {
                border-collapse: collapse;
                width: 100%;
                text-align: center;
            }

            .print {
                background: #2280ff;
                border-radius: 10px;
                border: 1px solid black;
                color: white;
                margin-bottom: 15px;
                padding: 5px 15px
            }

            .print:hover {
                background: #0d3569;

            }

            .logo {
                text-align: center;
            }

            .warranty {
                text-align: end;
            }

            .f-weight {
                font-weight: bold;
            }

            @media print {
                .print {
                    display: none;
                }

                * {
                    background: white;
                }

                footer {
                    /* display: none; */
                }
            }
        </style>
    @endpush
    <div class="row">
        <div class="col-md-12">
            @component('dashboard::components.box')
                @slot('class', 'p-0')
                @slot('bodyClass', 'p-0')
                <div class="row">
                    <div class="col-4">
                        <img src="{{ asset('images/HDL.jpeg') }}" alt="">
                    </div>
                    <div class="col-4 logo">
                        <img src="{{ asset('images/report_logo.jpeg') }}" alt="">
                    </div>
                    <div class="col-4 warranty">
                        <img src="{{ asset('images/warranty.jpeg') }}" alt="">
                    </div>
                </div>
                <div class="row">
                    <h4><span class="f-weight"> Date: </span>{{ $qutation->created_at }}</h4>
                </div>
                <div class="row">
                    <h4><span class="f-weight"> Quotation To: </span>{{ $qutation->customer->name }}</h4>
                </div>
                <button class="print" onclick="window.print()">print</button>
                <table class="qutation">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Picture</th>
                            <th>Brief Description</th>
                            <th>Model Number</th>
                            <th>Price</th>
                            <th>Q</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($qutation->products as $product)
                            <tr>
                                <td>800</td>
                                <td><img src="{{ $product->getFirstMediaUrl() }}" alt=""
                                        style="width:100px;height:100px"></td>
                                <td>{{ $product->description }}</td>
                                <td>{{ $product->model_number }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->pivot->quantity }}</td>
                                <td>{{ $product->price * $product->pivot->quantity }}</td>
                            </tr>
                        @endforeach
                        <tr style="border-bottom: 2px solid black;text-align: center">
                            <td colspan="7">
                                <h3>Subtotal in {{ $qutation->category->currency }} </h3>
                            </td>
                            <td> {{ $qutation->sub_total }}</td>
                        </tr>
                        <tr style="border-bottom: 2px solid black;text-align: center">
                            <td colspan="7">
                                <h3>Discount {{ $qutation->discount }}% </h3>
                            </td>
                            <td> {{ ($qutation->discount * $qutation->sub_total) / 100 }}</td>
                        </tr>
                        <tr style="border-bottom: 2px solid black;text-align: center">
                            <td colspan="7">
                                <h3>Installation Fees </h3>
                            </td>
                            <td> {{ $qutation->sub_total * ($qutation->installation_fees / 100) }}</td>
                        </tr>
                        <tr style="border-bottom: 2px solid black;text-align: center">
                            <td colspan="7">
                                <h3> Total with installation in {{ $qutation->category->currency }}
                                </h3>
                            </td>
                            <td> {{ $qutation->total - ($qutation->discount * $qutation->sub_total) / 100 }}</td>
                        </tr>
                        <tr style="border-bottom: 2px solid black;text-align: start">
                            <td style="border: none" colspan="10">Terms and Conditions : </td>
                        </tr>
                        <tr style="border-bottom: 2px solid black;text-align: start">
                            <td style="border: none;background: yellow" colspan="10">Notes: </td>
                        </tr>
                        <tr style="border-bottom: 2px solid black;text-align: start">

                            <td style="border: none" colspan="10">*The Above Prices doesn't include any taxes
                                ({{ Settings::get('tax') }}%) </td>
                        </tr>
                        <tr style="border-bottom: 2px solid black;text-align: start">
                            <td style="border: none" colspan="10">* These prices don’t include the transportation of the
                                products to the project’s site.</td>
                        </tr>
                        <tr style="border-bottom: 2px solid black;text-align: start">
                            <td style="border: none;background: yellow" colspan="10">Payment Method:</td>
                        </tr>
                        <tr style="border-bottom: 2px solid black;text-align: start">
                            <td style="border: none" colspan="10">* {{ Settings::get('down_payment') }}% of the total
                                price of the products will be paid as a down payment to begin contracting.</td>
                        </tr>
                        <tr style="border-bottom: 2px solid black;text-align: start">
                            <td style="border: none" colspan="10">* {{ Settings::get('remaining_payment') }}% of the
                                total price of the products will be paid on the same date of supplying the products to the
                                project site.</td>
                        </tr>
                        <tr style="border-bottom: 2px solid black;text-align: start">
                            <td style="border: none" colspan="10">*The additional {{ Settings::get('additional') }}% for
                                the installation and programming fees will be paid after programming the products max. by
                                {{ Settings::get('remaining_hour') }} hours.</td>
                        </tr>

                        <tr style="border-bottom: 2px solid black;text-align: start">
                            <td style="border: none;background: yellow" colspan="10">* Supplying the products will be Max.
                                After 90 days from the date of paying the down payment by the client.</td>
                        </tr>
                    </tbody>
                </table>
                <div style="margin-left: 3%">
                    <h4> NexGen</h4>
                    <p> <span style="font-weight: bold">Address</span>: {{ Settings::get('address') }}</p>
                    <p> <span style="font-weight: bold">Mobile</span>: {{ Settings::get('mobile') }}</p>
                    <p> <span style="font-weight: bold">Email</span>: {{ Settings::get('email') }}</p>
                </div>
                {{-- @slot('footer')
                    @include('dashboard.qutations.partials.actions.edit')
                    @include('dashboard.qutations.partials.actions.delete')
                @endslot --}}
            @endcomponent
        </div>
    </div>
</x-layout>
