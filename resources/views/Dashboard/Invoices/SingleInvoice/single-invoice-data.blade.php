<div>

    <table id="example" class="table key-buttons text-md-nowrap">
        <thead>
            <tr>
                <th>#</th>
                <th>{{ trans('Single_Invoice.service_name') }}</th>
                <th>{{ trans('Patients.patient_name') }}</th>
                <th>تاريخ الفاتورة</th>
                <th>اسم الدكتور</th>
                <th>القسم</th>
                <th>سعر الخدمة</th>
                <th>قيمة الخصم</th>
                <th>نسبة الضريبة</th>
                <th>قيمة الضريبة</th>
                <th>الاجمالي مع الضريبة</th>
                <th>نوع الفاتورة</th>
                <th>العمليات</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($single_invoices as $single_invoice)
                <tr wire:key="{{ $single_invoice->id }}">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $single_invoice->Service->name }}</td>
                    <td>{{ $single_invoice->Patient->name }}</td>
                    <td>{{ $single_invoice->invoice_date }}</td>
                    <td>{{ $single_invoice->Doctor->name }}</td>
                    <td>{{ $single_invoice->Section->name }}</td>
                    <td>{{ number_format($single_invoice->price, 2) }}</td>
                    <td>{{ number_format($single_invoice->discount_value, 2) }}</td>
                    <td>{{ $single_invoice->tax_rate }}%</td>
                    <td>{{ number_format($single_invoice->tax_value, 2) }}</td>
                    <td>{{ number_format($single_invoice->total_with_tax, 2) }}</td>
                    <td>{{ $single_invoice->type == 1 ? 'نقدي' : 'اجل' }}</td>
                    <td>
                        <button wire:click="$dispatch('update', { id: {{ $single_invoice->id }} })"
                            class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>
                        <button type="button" class="btn btn-danger btn-sm"
                            wire:click="$dispatch('delete', { id: {{ $single_invoice->id }} })"><i
                                class="fa fa-trash"></i></button>
                        <a href="{{ route('print_invoice', $single_invoice->id) }}" target="_blank" class="btn btn-primary btn-sm"><i
                                class="fas fa-print"></i></a>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
</div>
