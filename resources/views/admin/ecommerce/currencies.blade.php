@extends('admin.layouts.app')

@section('title', 'Currencies | Organic Tea Admin')

@section('content')
<div class="container-fluid">
    <div class="page-title-head d-flex align-items-center mb-3">
        <div class="flex-grow-1">
            <h4 class="page-main-title m-0">Currencies</h4>
        </div>
        <div>
            <a href="{{ route('admin.ecommerce.currency-create') }}" class="btn btn-primary">
                <i class="ti ti-plus me-1"></i> Add Currency
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-header border-light justify-content-between">
            <div class="d-flex flex-wrap gap-2 align-items-center">
                <form method="GET" action="{{ route('admin.ecommerce.currencies') }}" class="d-flex flex-wrap gap-2 align-items-center">
                    <div class="app-search">
                        <input type="text" name="search" class="form-control" placeholder="Search by name, code, symbol..." value="{{ request('search') }}" />
                        <i class="ti ti-search app-search-icon text-muted"></i>
                    </div>

                    <div>
                        <select name="status" class="form-select form-control my-1 my-md-0">
                            <option value="">All</option>
                            <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-soft-primary btn-sm">
                        <i class="ti ti-filter-2 me-1"></i> Filter
                    </button>

                    @if(request('search') || request('status'))
                        <a href="{{ route('admin.ecommerce.currencies') }}" class="btn btn-soft-danger btn-sm">
                            <i class="ti ti-x me-1"></i> Clear
                        </a>
                    @endif
                </form>
            </div>

            <div class="ms-auto">
                <span class="text-muted fs-sm">{{ $currencies->total() }} total currencies</span>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-custom table-centered table-hover w-100 mb-0">
                <thead class="bg-light bg-opacity-25 thead-sm">
                    <tr>
                        <th>ID</th>
                        <th>Code</th>
                        <th>Symbol</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Created</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($currencies as $currency)
                    <tr>
                        <td><span class="fw-semibold">#{{ $currency->id }}</span></td>
                        <td><span class="badge bg-light text-dark fw-semibold">{{ $currency->code }}</span></td>
                        <td><span class="fs-lg">{{ $currency->symbol ?? '-' }}</span></td>
                        <td>{{ $currency->name }}</td>
                        <td>
                            <form action="{{ route('admin.ecommerce.currency-toggle', $currency) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                @if($currency->status)
                                    <button type="submit" class="badge badge-soft-success border-0" title="Click to deactivate">
                                        Active
                                    </button>
                                @else
                                    <button type="submit" class="badge badge-soft-danger border-0" title="Click to activate">
                                        Inactive
                                    </button>
                                @endif
                            </form>
                        </td>
                        <td>{{ $currency->created_at->format('d M, Y') }}</td>
                        <td>
                            <div class="d-flex justify-content-center gap-1">
                                <a href="{{ route('admin.ecommerce.currency-edit', $currency) }}" class="btn btn-default btn-icon btn-sm" title="Edit" data-bs-toggle="tooltip" data-bs-placement="top">
                                    <i class="ti ti-edit fs-lg"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-4">
                            <div class="text-muted">
                                <i class="ti ti-coin-off fs-1"></i>
                                <p class="mt-2">No currencies found</p>
                                <a href="{{ route('admin.ecommerce.currency-create') }}" class="btn btn-primary btn-sm">
                                    <i class="ti ti-plus me-1"></i> Add Currency
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="card-footer border-0">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-muted fs-sm">
                    Showing {{ $currencies->firstItem() ?? 0 }} to {{ $currencies->lastItem() ?? 0 }} of {{ $currencies->total() }} results
                </div>
                <div>
                    {{ $currencies->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
