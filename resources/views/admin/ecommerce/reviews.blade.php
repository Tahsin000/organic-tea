@extends('admin.layouts.app')

@section('title', 'Reviews | Aroma Blend Admin')

@section('content')
<div class="container-fluid">
    <div class="page-title-head d-flex align-items-center mb-3">
        <div class="flex-grow-1">
            <h4 class="page-main-title m-0">Reviews</h4>
        </div>
        <div>
            <a href="{{ route('admin.ecommerce.review-create') }}" class="btn btn-primary">
                <i class="ti ti-plus me-1"></i> Add Review
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
                <form method="GET" action="{{ route('admin.ecommerce.reviews') }}" class="d-flex flex-wrap gap-2 align-items-center">
                    <div class="app-search">
                        <input type="text" name="search" class="form-control" placeholder="Search..." value="{{ request('search') }}" />
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
                        <a href="{{ route('admin.ecommerce.reviews') }}" class="btn btn-soft-danger btn-sm">
                            <i class="ti ti-x me-1"></i> Clear
                        </a>
                    @endif
                </form>
            </div>

            <div class="ms-auto">
                <span class="text-muted fs-sm">{{ $reviews->total() }} total reviews</span>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-custom table-centered table-hover w-100 mb-0">
                <thead class="bg-light bg-opacity-25 thead-sm">
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Location</th>
                        <th>Product</th>
                        <th>Review</th>
                        <th>Stars</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reviews as $review)
                    <tr>
                        <td><span class="fw-semibold">#{{ $review->id }}</span></td>
                        <td>
                            @if($review->image)
                                <img src="{{ $review->image_url }}" alt="" class="rounded" style="width:40px;height:40px;object-fit:cover;" />
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>{{ $review->name }}</td>
                        <td>{{ $review->location ?? '-' }}</td>
                        <td>
                            @if($review->product_id && $review->product)
                                <span class="badge badge-soft-primary">{{ $review->product->name }}</span>
                            @else
                                <span class="text-muted">General</span>
                            @endif
                        </td>
                        <td>{{ Str::limit($review->text, 50) }}</td>
                        <td>
                            @for($i = 0; $i < $review->stars; $i++)
                                <i class="ti ti-star-filled text-warning fs-sm"></i>
                            @endfor
                            @for($i = $review->stars; $i < 5; $i++)
                                <i class="ti ti-star text-muted fs-sm"></i>
                            @endfor
                        </td>
                        <td>
                            <form action="{{ route('admin.ecommerce.review-toggle', $review) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                @if($review->status)
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
                        <td>{{ $review->created_at->format('d M, Y') }}</td>
                        <td>
                            <div class="d-flex justify-content-center gap-1">
                                <a href="{{ route('admin.ecommerce.review-edit', $review) }}" class="btn btn-default btn-icon btn-sm" title="Edit" data-bs-toggle="tooltip" data-bs-placement="top">
                                    <i class="ti ti-edit fs-lg"></i>
                                </a>
                                <button type="button" class="btn btn-default btn-icon btn-sm delete-review-btn" title="Delete" data-bs-toggle="modal" data-bs-target="#deleteReviewModal" data-review-id="{{ $review->id }}" data-review-name="{{ $review->name }}">
                                    <i class="ti ti-trash fs-lg"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="10" class="text-center py-4">
                            <div class="text-muted">
                                <i class="ti ti-star-off fs-1"></i>
                                <p class="mt-2">No reviews found</p>
                                <a href="{{ route('admin.ecommerce.review-create') }}" class="btn btn-primary btn-sm">
                                    <i class="ti ti-plus me-1"></i> Add Review
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
                    Showing {{ $reviews->firstItem() ?? 0 }} to {{ $reviews->lastItem() ?? 0 }} of {{ $reviews->total() }} results
                </div>
                <div>
                    {{ $reviews->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Review Modal -->
<div class="modal fade" id="deleteReviewModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Delete Review</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="mb-0">Are you sure you want to delete review by <strong id="delete-review-name"></strong>? This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                <form id="delete-review-form" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">
                        <i class="ti ti-trash me-1"></i> Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.getElementById('deleteReviewModal').addEventListener('show.bs.modal', function (e) {
    var button = e.relatedTarget;
    var reviewId = button.getAttribute('data-review-id');
    var reviewName = button.getAttribute('data-review-name');
    document.getElementById('delete-review-name').textContent = reviewName;
    document.getElementById('delete-review-form').action = '/admin/ecommerce/reviews/' + reviewId;
});
</script>
@endpush
