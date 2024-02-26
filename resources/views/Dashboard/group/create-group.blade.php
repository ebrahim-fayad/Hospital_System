<div>

    <div id='ServiceSaved'>
        @session('saved')
            <div class="alert alert-info">{{ $value}}</div>
        @endsession
    </div>
    @if ($showTable)
        <button class="btn btn-primary pull-right" wire:click="showFormAdd"
            type="button">{{ trans('Groups.add_services_groups') }}
        </button><br><br>
        <div class="table-responsive">
            <table class="table text-md-nowrap" id="example1" data-page-length="50"style="text-align: center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ trans('Groups.group_name') }}</th>
                        <th>{{ trans('Groups.price_task') }}</th>
                        <th>{{ trans('Groups.notes') }}</th>
                        <th>{{ trans('Groups.processes') }}</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($groups as $group)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $group->name }}</td>
                            <td>{{ number_format($group->Total_with_tax, 2) }}</td>
                            <td>{{ $group->notes }}</td>
                            <td>
                                <button wire:click="edit({{ $group->id }})" class="btn btn-primary btn-sm"><i
                                        class="fa fa-edit"></i></button>

                                   <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteGroup{{$group->id}}"><i class="fa fa-trash"></i></button>

                            </td>
                        </tr>
                        @include('Dashboard.group.delete')
                    @endforeach
            </table>
        </div>
    @else
        @session('servicesCountError')
            <div class="alert alert-danger">{{ $value }}</div>
        @endsession


        <form wire:submit.prevent="saveGroup" autocomplete="off">
            @csrf
            <div class="form-group">
                <label>{{ trans('Groups.group_name') }}</label>
                <input wire:model.live="name" type="text" name="name" class="form-control" required>
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>{{ trans('Groups.notes') }}</label>
                <textarea wire:model.live="notes" name="notes" class="form-control" rows="5"></textarea>
            </div>

            <div class="card mt-4">
                <div class="card-header">
                    <div class="col-md-12">
                        <button class="btn btn-outline-primary" wire:click.prevent="addService">{{ trans('Groups.add_services_groups') }}
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr class="table-primary">
                                    <th>{{ trans('Groups.group_name') }}</th>
                                    <th width="200">{{ trans('Groups.quantity') }}</th>
                                    <th width="200">{{ trans('Groups.processes') }}</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($GroupsItems as $index => $groupItem)
                                    <tr>
                                        <td>
                                            @if ($groupItem['is_saved'])
                                                @if ($groupItem['service_name'] && $groupItem['service_price'])
                                                    {{ $groupItem['service_name'] }}
                                                    ({{ number_format($groupItem['service_price'], 2) }})
                                                @endif
                                            @else
                                                <select
                                                    class="form-control{{ session('error') || session('errorEdit') ? ' is-invalid' : '' }}"
                                                    wire:model.live="GroupsItems.{{ $index }}.service_id">
                                                    <option value="">-- choose product --</option>
                                                    @foreach ($allServices as $service)
                                                        <option value="{{ $service->id }}">
                                                            {{ $service->name }}
                                                            ({{ number_format($service->price, 2) }})
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @if (session('error'))
                                                    <span class="text-danger">{{ session('error') }}</span>
                                                @endif
                                                @if (session('errorEdit'))
                                                    <span class="text-danger">{{ session('errorEdit') }}</span>
                                                @endif
                                            @endif
                                        </td>
                                        <td>
                                            @if ($groupItem['is_saved'])
                                                <input type="number"
                                                    wire:model="GroupsItems.{{ $index }}.quantity"{{ $groupItem['is_saved'] ? ' disabled' : '' }}
                                                    min="0" />
                                            @else
                                                <input type="number" class="form-control"
                                                    wire:model.live="GroupsItems.{{ $index }}.quantity"
                                                    min="0" />
                                            @endif
                                        </td>

                                        <td>
                                            @if ($groupItem['is_saved'])
                                                <button class="btn btn-sm btn-primary"
                                                    wire:click.prevent="editService({{ $index }})">
                                                    {{ trans('Groups.edite') }}
                                                </button>
                                            @elseif($groupItem['service_id'])
                                                <button class="btn btn-sm btn-success mr-1"
                                                    wire:click.prevent="saveService({{ $index }})">
                                                    {{ trans('Groups.submit') }}
                                                </button>
                                            @endif
                                            <button class="btn btn-sm btn-danger"
                                                wire:click.prevent="removeService({{ $index }})">{{ trans('Groups.delete') }}
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>


                    <div class="col-lg-4  ">
                        <table class="table pull-right">
                            <tr>
                                <td style="color: red">{{ trans('Groups.total') }}</td>
                                <td>{{ number_format($subtotal, 2) }}</td>
                            </tr>

                            <tr>
                                <td style="color: red">{{ trans('Groups.discount_value') }}</td>
                                <td width="125">
                                    <input type="number" name="discount_value" class="form-control w-75 d-inline"
                                        wire:model.live="discount_value">
                                </td>
                            </tr>

                            <tr>
                                <td style="color: red">{{ trans('Groups.Tax_rate') }}</td>
                                <td>
                                    <input type="number" name="taxes" class="form-control w-75 d-inline"
                                        min="0" max="100" wire:model.live="taxes"> %
                                    @session('taxesError')
                                        <div class="text-danger">{{ session('taxesError') }}</div>
                                    @endsession
                                </td>
                            </tr>
                            <tr>
                                <td style="color: red">{{ trans('Groups.Total_with_tax') }}</td>
                                <td>{{ number_format($total, 2) }}</td>
                            </tr>
                        </table>
                    </div> <br />
                    <div>
                        <button class="btn btn-outline-success" type="submit">{{ trans('Groups.confirm_data') }}</button>
                    </div>
                </div>
            </div>

        </form>


    @endif
</div>
