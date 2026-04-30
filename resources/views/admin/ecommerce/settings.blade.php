@extends('admin.layouts.app')

@section('title', 'Landing Content Settings | Aroma Blend Admin')

@section('content')
<div class="container-fluid">
    <div class="page-title-head d-flex align-items-center mb-3">
        <div class="flex-grow-1">
            <h4 class="page-main-title m-0">Landing Content Settings</h4>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show">
            <ul class="mb-0">
                @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-header border-light">
            <ul class="nav nav-tabs card-header-tabs" id="settingsTabs" role="tablist">
                @foreach($sections as $key => $label)
                    <li class="nav-item">
                        <button class="nav-link {{ $loop->first ? 'active' : '' }}" id="tab-{{ $key }}" data-bs-toggle="tab" data-bs-target="#panel-{{ $key }}" type="button" role="tab">
                            {{ $label }}
                        </button>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="card-body">
            <div class="tab-content" id="settingsTabContent">
                @foreach($sections as $key => $label)
                    <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="panel-{{ $key }}" role="tabpanel">
                        @include('admin.ecommerce.settings.partials.' . $key)
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

{{-- Dynamic array item templates --}}
<template id="tmpl-features">
    <div class="card mb-3 array-item" data-group="features">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="badge bg-primary feature-badge">Feature</span>
                <button type="button" class="btn btn-sm btn-outline-danger btn-remove-item">
                    <i class="ti ti-trash"></i>
                </button>
            </div>
            <div class="row">
                <div class="col-md-3 mb-2">
                    <label class="form-label small">Icon</label>
                    <select class="form-select form-select-sm" data-field="icon">
                        <option value="shield">Shield</option>
                        <option value="truck">Truck</option>
                        <option value="star">Star</option>
                        <option value="bolt">Bolt</option>
                    </select>
                </div>
                <div class="col-md-4 mb-2">
                    <label class="form-label small">Title</label>
                    <input type="text" class="form-control form-control-sm" data-field="title" />
                </div>
                <div class="col-md-5 mb-2">
                    <label class="form-label small">Description</label>
                    <input type="text" class="form-control form-control-sm" data-field="desc" />
                </div>
            </div>
        </div>
    </div>
</template>

<template id="tmpl-steps">
    <div class="card mb-3 array-item" data-group="steps">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="badge bg-primary step-badge">Step</span>
                <button type="button" class="btn btn-sm btn-outline-danger btn-remove-item">
                    <i class="ti ti-trash"></i>
                </button>
            </div>
            <div class="row">
                <div class="col-md-4 mb-2">
                    <label class="form-label small">Title</label>
                    <input type="text" class="form-control form-control-sm" data-field="title" />
                </div>
                <div class="col-md-8 mb-2">
                    <label class="form-label small">Description</label>
                    <textarea class="form-control form-control-sm" data-field="desc" rows="2"></textarea>
                </div>
            </div>
        </div>
    </div>
</template>

<template id="tmpl-quick_links">
    <div class="card mb-2 array-item" data-group="quick_links">
        <div class="card-body py-2">
            <div class="d-flex justify-content-between align-items-center mb-1">
                <span class="badge bg-secondary link-badge">Link</span>
                <button type="button" class="btn btn-sm btn-outline-danger btn-remove-item">
                    <i class="ti ti-trash"></i>
                </button>
            </div>
            <div class="row align-items-center">
                <div class="col-md-4 mb-2 mb-md-0">
                    <label class="form-label small mb-1">Label</label>
                    <input type="text" class="form-control form-control-sm" data-field="label" />
                </div>
                <div class="col-md-8">
                    <label class="form-label small mb-1">URL</label>
                    <input type="text" class="form-control form-control-sm" data-field="href" />
                </div>
            </div>
        </div>
    </div>
</template>

<template id="tmpl-stats">
    <div class="row mb-2 array-item" data-group="stats">
        <div class="col-md-5 mb-2 mb-md-0">
            <label class="form-label small">Value</label>
            <input type="text" class="form-control form-control-sm" data-field="value" />
        </div>
        <div class="col-md-5 mb-2 mb-md-0">
            <label class="form-label small">Label</label>
            <input type="text" class="form-control form-control-sm" data-field="label" />
        </div>
        <div class="col-md-2 d-flex align-items-end">
            <button type="button" class="btn btn-sm btn-outline-danger btn-remove-item w-100">
                <i class="ti ti-trash"></i>
            </button>
        </div>
    </div>
</template>

<template id="tmpl-emails">
    <div class="card mb-2 array-item" data-group="emails">
        <div class="card-body py-2">
            <div class="row align-items-center">
                <div class="col-md-6 mb-2 mb-md-0">
                    <label class="form-label small mb-1">Email</label>
                    <input type="email" class="form-control form-control-sm" data-field="email" placeholder="notifications@example.com" />
                </div>
                <div class="col-md-3 mb-2 mb-md-0">
                    <div class="form-check form-switch">
                        <input class="form-check-input email-active-toggle" type="checkbox" data-field="active" checked>
                        <label class="form-check-label small">Active</label>
                    </div>
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <button type="button" class="btn btn-sm btn-outline-danger btn-remove-item w-100">
                        <i class="ti ti-trash"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<template id="tmpl-texts">
    <div class="card mb-3 array-item" data-group="texts">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="badge bg-primary ribbon-text-badge">Text</span>
                <button type="button" class="btn btn-sm btn-outline-danger btn-remove-item">
                    <i class="ti ti-trash"></i>
                </button>
            </div>
            <div class="row">
                <div class="col-md-3 mb-2">
                    <label class="form-label small">Badge</label>
                    <input type="text" class="form-control form-control-sm" data-field="badge_text" placeholder="অফার" />
                </div>
                <div class="col-md-5 mb-2">
                    <label class="form-label small">Promotion Text</label>
                    <input type="text" class="form-control form-control-sm" data-field="promotion_text" placeholder="20% ছাড় সকল পণ্যে" />
                </div>
                <div class="col-md-2 mb-2">
                    <label class="form-label small">CTA</label>
                    <input type="text" class="form-control form-control-sm" data-field="cta" placeholder="অফার দেখুন" />
                </div>
                <div class="col-md-2 mb-2">
                    <label class="form-label small">Link</label>
                    <input type="text" class="form-control form-control-sm" data-field="link_url" placeholder="#offer" />
                </div>
            </div>
        </div>
    </div>
</template>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Status toggle: update hidden status input + label
    document.querySelectorAll('.section-status-toggle').forEach(function(toggle) {
        toggle.addEventListener('change', function() {
            const form = this.closest('form');
            const hiddenStatus = form.querySelector('[data-field="status"]');
            const label = this.parentElement.querySelector('label.form-check-label');
            if (hiddenStatus) {
                hiddenStatus.value = this.checked ? '1' : '0';
            }
            if (label) {
                label.textContent = this.checked ? 'Enabled' : 'Disabled';
            }
        });
    });

    // Add item buttons
    document.querySelectorAll('.btn-add-item').forEach(function(btn) {
        btn.addEventListener('click', function() {
            const group = this.dataset.group;
            const tmpl = document.getElementById('tmpl-' + group);
            if (!tmpl) return;

            const clone = tmpl.content.cloneNode(true);
            const container = this.closest('form').querySelector('.array-container[data-group="' + group + '"]');
            if (container) {
                container.appendChild(clone);
            } else {
                this.parentElement.insertBefore(clone, this);
            }
            updateBadges();
        });
    });

    // Remove item buttons (delegated)
    document.addEventListener('click', function(e) {
        const btn = e.target.closest('.btn-remove-item');
        if (btn) {
            const item = btn.closest('.array-item');
            if (item) {
                item.remove();
                updateBadges();
            }
        }
    });

    // Form submit
    document.querySelectorAll('.landing-form').forEach(function(form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const fields = gatherFields(form);
            submitForm(form, fields);
        });
    });

    /**
     * Gather form data: scalar fields + grouped array fields.
     * Scalars: [data-field] NOT inside .array-item
     * Arrays: .array-container items grouped by data-group
     */
    function gatherFields(form) {
        const fields = {};
        const section = form.querySelector('[name="section"]')?.value || '';

        // 1. Gather scalar fields (not inside array items)
        form.querySelectorAll(':scope [data-field]').forEach(function(input) {
            if (input.closest('.array-item')) return;

            const key = input.dataset.field;
            const val = input.value;

            // Ribbon section: timer fields → nested object
            if (section === 'ribbon' && key.startsWith('ribbon_timer_')) {
                if (!fields.timer) fields.timer = {};
                const timerKey = key.replace('ribbon_timer_', '');
                if (timerKey === 'enabled') {
                    fields.timer.enabled = val === '1';
                } else if (timerKey === 'label') {
                    fields.timer.countdown_label = val;
                } else if (timerKey === 'start') {
                    fields.timer.start_date = val;
                } else if (timerKey === 'end') {
                    fields.timer.end_date = val;
                }
                return;
            }

            // Offer section: flat timer_enabled key
            if (key === 'timer_enabled') {
                fields.timer_enabled = val === '1' ? 1 : 0;
                return;
            }

            if (key === 'status') {
                fields[key] = val === '1' ? 1 : 0;
            } else {
                fields[key] = val;
            }
        });

        // 2. Gather array fields by group
        form.querySelectorAll('.array-container').forEach(function(container) {
            const group = container.dataset.group;
            if (!group) return;

            const items = [];
            container.querySelectorAll('.array-item').forEach(function(item) {
                const entry = {};
                item.querySelectorAll('[data-field]').forEach(function(input) {
                    const key = input.dataset.field;
                    if (key === 'active') {
                        entry[key] = input.checked;
                    } else {
                        entry[key] = input.value;
                    }
                });
                if (Object.values(entry).some(v => v !== '' && v !== false)) {
                    items.push(entry);
                }
            });

            fields[group] = items;
        });

        return fields;
    }

    function submitForm(form, fields) {
        const hidden = form.querySelector('#fields-json');
        hidden.value = JSON.stringify(fields);
        form.submit();
    }

    function updateBadges() {
        document.querySelectorAll('.array-container').forEach(function(container) {
            const group = container.dataset.group || '';
            container.querySelectorAll('.array-item').forEach(function(item, idx) {
                const badge = item.querySelector('.feature-badge, .step-badge, .link-badge');
                if (badge) {
                    if (badge.classList.contains('feature-badge')) badge.textContent = 'Feature ' + (idx + 1);
                    if (badge.classList.contains('step-badge')) badge.textContent = 'Step ' + (idx + 1);
                    if (badge.classList.contains('link-badge')) badge.textContent = 'Link ' + (idx + 1);
                }
            });
        });
    }
});
</script>
@endpush
