<!-- Topbar End -->
<div class="sidenav-menu">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard.ecommerce') }}" class="logo">
        <span class="logo logo-light">
            <span class="logo-lg"><img src="{{ asset('assets/images/logo.png') }}" alt="logo" /></span>
            <span class="logo-sm"><img src="{{ asset('assets/images/logo-sm.png') }}" alt="small logo" /></span>
        </span>

        <span class="logo logo-dark">
            <span class="logo-lg"><img src="{{ asset('assets/images/logo-black.png') }}" alt="dark logo" /></span>
            <span class="logo-sm"><img src="{{ asset('assets/images/logo-sm.png') }}" alt="small logo" /></span>
        </span>
    </a>

    <!-- Sidebar Hover Menu Toggle Button -->
    <button class="button-on-hover">
        <span class="btn-on-hover-icon"></span>
    </button>

    <!-- Full Sidebar Menu Close Button -->
    <button class="button-close-offcanvas">
        <i class="ti ti-menu-4 align-middle"></i>
    </button>

    <div class="scrollbar" data-simplebar="">
        <div id="user-profile-settings" class="sidenav-user" style="background: url(assets/images/user-bg-pattern.svg)">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <a href="#!" class="link-reset">
                        <img src="{{ asset('assets/images/users/user-1.jpg') }}" alt="user-image"
                            class="rounded-circle mb-2 avatar-md" />
                        <span class="sidenav-user-name fw-bold">David Dev</span>
                        <span class="fs-12 fw-semibold" data-lang="user-role">Art Director</span>
                    </a>
                </div>
                <div>
                    <a class="dropdown-toggle drop-arrow-none link-reset sidenav-user-set-icon"
                        data-bs-toggle="dropdown" data-bs-offset="0,12" href="#!" aria-haspopup="false"
                        aria-expanded="false">
                        <i class="ti ti-settings fs-24 align-middle ms-1"></i>
                    </a>

                    <div class="dropdown-menu">
                        <!-- Header -->
                        <div class="dropdown-header noti-title">
                            <h6 class="text-overflow m-0">Welcome back!</h6>
                        </div>

                        <!-- My Profile -->
                        <a href="#!" class="dropdown-item">
                            <i class="ti ti-user-circle me-1 fs-lg align-middle"></i>
                            <span class="align-middle">Profile</span>
                        </a>

                        <!-- Settings -->
                        <a href="javascript:void(0);" class="dropdown-item">
                            <i class="ti ti-settings-2 me-1 fs-lg align-middle"></i>
                            <span class="align-middle">Account Settings</span>
                        </a>

                        <!-- Lock -->
                        <a href="#" class="dropdown-item">
                            <i class="ti ti-lock me-1 fs-lg align-middle"></i>
                            <span class="align-middle">Lock Screen</span>
                        </a>

                        <!-- Logout -->
                        <a href="javascript:void(0);" class="dropdown-item text-danger fw-semibold">
                            <i class="ti ti-logout me-1 fs-lg align-middle"></i>
                            <span class="align-middle">Log Out</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!--- Sidenav Menu -->
        <div id="sidenav-menu">
            <ul class="side-nav">
                <li class="side-nav-title mt-2" data-lang="main">Main</li>
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#dashboards" aria-expanded="false" aria-controls="dashboards"
                        class="side-nav-link">
                        <span class="menu-icon"><i class="ti ti-dashboard"></i></span>
                        <span class="menu-text" data-lang="dashboards">Dashboards</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse {{ request()->routeIs('admin.dashboard.*') ? 'show' : '' }}" id="dashboards">
                        <ul class="sub-menu">
                            <li class="side-nav-item">
                                <a href="{{ route('admin.dashboard.ecommerce') }}" class="side-nav-link {{ request()->routeIs('admin.dashboard.ecommerce') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="dashboard-ecommerce">Ecommerce</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.dashboard.analytics') }}" class="side-nav-link {{ request()->routeIs('admin.dashboard.analytics') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="dashboard-analytics">Analytics</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.dashboard.crm') }}" class="side-nav-link {{ request()->routeIs('admin.dashboard.crm') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="dashboard-crm">CRM</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.dashboard.finance') }}" class="side-nav-link {{ request()->routeIs('admin.dashboard.finance') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="dashboard-finance">Finance</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.dashboard.projects') }}" class="side-nav-link {{ request()->routeIs('admin.dashboard.projects') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="dashboard-projects">Projects</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="side-nav-title mt-2" data-lang="apps">Apps</li>
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#ecommerce" aria-expanded="false" aria-controls="ecommerce"
                        class="side-nav-link">
                        <span class="menu-icon"><i class="ti ti-basket"></i></span>
                        <span class="menu-text" data-lang="ecommerce">Ecommerce</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse {{ request()->routeIs('admin.ecommerce.*') ? 'show' : '' }}" id="ecommerce">
                        <ul class="sub-menu">
                            <li class="side-nav-item">
                                <a data-bs-toggle="collapse" href="#products" aria-expanded="false"
                                    aria-controls="products" class="side-nav-link">
                                    <span class="menu-text" data-lang="products">Products</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse {{ request()->routeIs('admin.ecommerce.product*') ? 'show' : '' }}" id="products">
                                    <ul class="sub-menu">
                                        <li class="side-nav-item">
                                            <a href="{{ route('admin.ecommerce.products') }}" class="side-nav-link {{ request()->routeIs('admin.ecommerce.products') ? 'active' : '' }}">
                                                <span class="menu-text"
                                                    data-lang="apps-ecommerce-products">Products</span>
                                            </a>
                                        </li>
                                        <li class="side-nav-item">
                                            <a href="{{ route('admin.ecommerce.products-grid') }}" class="side-nav-link {{ request()->routeIs('admin.ecommerce.products-grid') ? 'active' : '' }}">
                                                <span class="menu-text"
                                                    data-lang="apps-ecommerce-products-grid">Products
                                                    Grid</span>
                                            </a>
                                        </li>
                                        <li class="side-nav-item">
                                            <a href="{{ route('admin.ecommerce.product-details') }}" class="side-nav-link {{ request()->routeIs('admin.ecommerce.product-details') ? 'active' : '' }}">
                                                <span class="menu-text"
                                                    data-lang="apps-ecommerce-product-details">Product
                                                    Details</span>
                                            </a>
                                        </li>
                                        <li class="side-nav-item">
                                            <a href="{{ route('admin.ecommerce.product-add') }}" class="side-nav-link {{ request()->routeIs('admin.ecommerce.product-add') ? 'active' : '' }}">
                                                <span class="menu-text" data-lang="apps-ecommerce-product-add">Add
                                                    Product</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.ecommerce.categories') }}" class="side-nav-link {{ request()->routeIs('admin.ecommerce.categories') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="apps-ecommerce-categories">Categories</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a data-bs-toggle="collapse" href="#orders" aria-expanded="false"
                                    aria-controls="orders" class="side-nav-link">
                                    <span class="menu-text" data-lang="orders">Orders</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse {{ request()->routeIs('admin.ecommerce.order*') ? 'show' : '' }}" id="orders">
                                    <ul class="sub-menu">
                                        <li class="side-nav-item">
                                            <a href="{{ route('admin.ecommerce.orders') }}" class="side-nav-link {{ request()->routeIs('admin.ecommerce.orders') ? 'active' : '' }}">
                                                <span class="menu-text"
                                                    data-lang="apps-ecommerce-orders">Orders</span>
                                            </a>
                                        </li>
                                        <li class="side-nav-item">
                                            <a href="{{ route('admin.ecommerce.order-details') }}" class="side-nav-link {{ request()->routeIs('admin.ecommerce.order-details') ? 'active' : '' }}">
                                                <span class="menu-text" data-lang="apps-ecommerce-order-details">Order
                                                    Details</span>
                                            </a>
                                        </li>
                                        <li class="side-nav-item">
                                            <a href="{{ route('admin.ecommerce.order-add') }}" class="side-nav-link {{ request()->routeIs('admin.ecommerce.order-add') ? 'active' : '' }}">
                                                <span class="menu-text" data-lang="apps-ecommerce-order-add">Add/Edit
                                                    Order</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.ecommerce.customers') }}" class="side-nav-link {{ request()->routeIs('admin.ecommerce.customers') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="apps-ecommerce-customers">Customers</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.ecommerce.cart') }}" class="side-nav-link {{ request()->routeIs('admin.ecommerce.cart') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="apps-ecommerce-cart">Cart</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.ecommerce.checkout') }}" class="side-nav-link {{ request()->routeIs('admin.ecommerce.checkout') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="apps-ecommerce-checkout">Checkout</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a data-bs-toggle="collapse" href="#sellers" aria-expanded="false"
                                    aria-controls="sellers" class="side-nav-link">
                                    <span class="menu-text" data-lang="sellers">Sellers</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse {{ request()->routeIs('admin.ecommerce.seller*') ? 'show' : '' }}" id="sellers">
                                    <ul class="sub-menu">
                                        <li class="side-nav-item">
                                            <a href="{{ route('admin.ecommerce.sellers') }}" class="side-nav-link {{ request()->routeIs('admin.ecommerce.sellers') ? 'active' : '' }}">
                                                <span class="menu-text"
                                                    data-lang="apps-ecommerce-sellers">Sellers</span>
                                            </a>
                                        </li>
                                        <li class="side-nav-item">
                                            <a href="{{ route('admin.ecommerce.seller-details') }}" class="side-nav-link {{ request()->routeIs('admin.ecommerce.seller-details') ? 'active' : '' }}">
                                                <span class="menu-text"
                                                    data-lang="apps-ecommerce-seller-details">Sellers
                                                    Details</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.ecommerce.refunds') }}" class="side-nav-link {{ request()->routeIs('admin.ecommerce.refunds') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="apps-ecommerce-refunds">Refunds</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.ecommerce.reviews') }}" class="side-nav-link {{ request()->routeIs('admin.ecommerce.reviews') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="apps-ecommerce-reviews">Reviews</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a data-bs-toggle="collapse" href="#inventory" aria-expanded="false"
                                    aria-controls="inventory" class="side-nav-link">
                                    <span class="menu-text" data-lang="inventory">Inventory</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse {{ request()->routeIs('admin.ecommerce.warehouse') ? 'show' : '' }}" id="inventory">
                                    <ul class="sub-menu">
                                        <li class="side-nav-item">
                                            <a href="{{ route('admin.ecommerce.warehouse') }}" class="side-nav-link {{ request()->routeIs('admin.ecommerce.warehouse') ? 'active' : '' }}">
                                                <span class="menu-text"
                                                    data-lang="apps-ecommerce-warehouse">Warehouse</span>
                                            </a>
                                        </li>
                                        <li class="side-nav-item">
                                            <a href="{{ route('admin.ecommerce.product-stocks') }}" class="side-nav-link {{ request()->routeIs('admin.ecommerce.product-stocks') ? 'active' : '' }}">
                                                <span class="menu-text"
                                                    data-lang="apps-ecommerce-product-stocks">Product
                                                    Stocks</span>
                                            </a>
                                        </li>
                                        <li class="side-nav-item">
                                            <a href="{{ route('admin.ecommerce.purchased-orders') }}" class="side-nav-link {{ request()->routeIs('admin.ecommerce.purchased-orders') ? 'active' : '' }}">
                                                <span class="menu-text"
                                                    data-lang="apps-ecommerce-purchased-orders">Purchased
                                                    Orders</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="side-nav-item">
                                <a data-bs-toggle="collapse" href="#reports" aria-expanded="false"
                                    aria-controls="reports" class="side-nav-link">
                                    <span class="menu-text" data-lang="reports">Reports</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse {{ request()->routeIs('admin.ecommerce.product-views') ? 'show' : '' }}" id="reports">
                                    <ul class="sub-menu">
                                        <li class="side-nav-item">
                                            <a href="{{ route('admin.ecommerce.product-views') }}" class="side-nav-link {{ request()->routeIs('admin.ecommerce.product-views') ? 'active' : '' }}">
                                                <span class="menu-text"
                                                    data-lang="apps-ecommerce-product-views">Product
                                                    Views</span>
                                            </a>
                                        </li>
                                        <li class="side-nav-item">
                                            <a href="{{ route('admin.ecommerce.sales') }}" class="side-nav-link {{ request()->routeIs('admin.ecommerce.sales') ? 'active' : '' }}">
                                                <span class="menu-text" data-lang="apps-ecommerce-sales">Sales</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.ecommerce.attributes') }}" class="side-nav-link {{ request()->routeIs('admin.ecommerce.attributes') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="apps-ecommerce-attributes">Attributes</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.ecommerce.settings') }}" class="side-nav-link {{ request()->routeIs('admin.ecommerce.settings') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="apps-ecommerce-settings">Settings</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="side-nav-item">
                    <a href="{{ route('admin.apps.chat') }}" class="side-nav-link {{ request()->routeIs('admin.apps.chat') ? 'active' : '' }}">
                        <span class="menu-icon"><i class="ti ti-message"></i></span>
                        <span class="menu-text" data-lang="apps-chat">Chat</span>
                    </a>
                </li>
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#projects" aria-expanded="false" aria-controls="projects"
                        class="side-nav-link">
                        <span class="menu-icon"><i class="ti ti-briefcase"></i></span>
                        <span class="menu-text" data-lang="projects">Projects</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse {{ request()->routeIs('admin.projects.*') ? 'show' : '' }}" id="projects">
                        <ul class="sub-menu">
                            <li class="side-nav-item">
                                <a href="{{ route('admin.projects.grid') }}" class="side-nav-link {{ request()->routeIs('admin.projects.grid') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="apps-projects-grid">My Projects</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.projects.list') }}" class="side-nav-link {{ request()->routeIs('admin.projects.list') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="apps-projects-list">Projects List</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.projects.details') }}" class="side-nav-link {{ request()->routeIs('admin.projects.details') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="apps-projects-details">View
                                        Project</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.projects.kanban') }}" class="side-nav-link {{ request()->routeIs('admin.projects.kanban') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="apps-projects-kanban">Kanban Board</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.projects.team-board') }}" class="side-nav-link {{ request()->routeIs('admin.projects.team-board') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="apps-projects-team-board">Team
                                        Board</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.projects.activity') }}" class="side-nav-link {{ request()->routeIs('admin.projects.activity') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="apps-projects-activity">Activity
                                        Steam</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#tasks" aria-expanded="false" aria-controls="tasks"
                        class="side-nav-link">
                        <span class="menu-icon"><i class="ti ti-list-check"></i></span>
                        <span class="menu-text" data-lang="tasks">Tasks</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse {{ request()->routeIs('admin.tasks.*') ? 'show' : '' }}" id="tasks">
                        <ul class="sub-menu">
                            <li class="side-nav-item">
                                <a href="{{ route('admin.tasks.list') }}" class="side-nav-link {{ request()->routeIs('admin.tasks.list') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="apps-task-list">Task List</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.tasks.details') }}" class="side-nav-link {{ request()->routeIs('admin.tasks.details') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="apps-task-details">Task Details</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.tasks.create') }}" class="side-nav-link {{ request()->routeIs('admin.tasks.create') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="apps-task-create">Create Task</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#invoice" aria-expanded="false" aria-controls="invoice"
                        class="side-nav-link">
                        <span class="menu-icon"><i class="ti ti-invoice"></i></span>
                        <span class="menu-text" data-lang="invoice">Invoice</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse {{ request()->routeIs('admin.invoice.*') ? 'show' : '' }}" id="invoice">
                        <ul class="sub-menu">
                            <li class="side-nav-item">
                                <a href="{{ route('admin.invoice.list') }}" class="side-nav-link {{ request()->routeIs('admin.invoice.list') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="apps-invoice-list">Invoices</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.invoice.details') }}" class="side-nav-link {{ request()->routeIs('admin.invoice.details') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="apps-invoice-details">Single
                                        Invoice</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.invoice.create') }}" class="side-nav-link {{ request()->routeIs('admin.invoice.create') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="apps-invoice-create">New Invoice</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#crm" aria-expanded="false" aria-controls="crm"
                        class="side-nav-link">
                        <span class="menu-icon"><i class="ti ti-heart-handshake"></i></span>
                        <span class="menu-text" data-lang="crm">CRM</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse {{ request()->routeIs('admin.crm.*') ? 'show' : '' }}" id="crm">
                        <ul class="sub-menu">
                            <li class="side-nav-item">
                                <a href="{{ route('admin.crm.contacts') }}" class="side-nav-link {{ request()->routeIs('admin.crm.contacts') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="apps-crm-contacts">Contacts</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.crm.opportunities') }}" class="side-nav-link {{ request()->routeIs('admin.crm.opportunities') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="apps-crm-opportunities">Opportunities</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.crm.deals') }}" class="side-nav-link {{ request()->routeIs('admin.crm.deals') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="apps-crm-deals">Deals</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.crm.leads') }}" class="side-nav-link {{ request()->routeIs('admin.crm.leads') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="apps-crm-leads">Leads</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.crm.pipeline') }}" class="side-nav-link {{ request()->routeIs('admin.crm.pipeline') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="apps-crm-pipeline">Pipeline</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.crm.campaign') }}" class="side-nav-link {{ request()->routeIs('admin.crm.campaign') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="apps-crm-campaign">Campaign</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.crm.proposals') }}" class="side-nav-link {{ request()->routeIs('admin.crm.proposals') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="apps-crm-proposals">Proposals</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.crm.estimations') }}" class="side-nav-link {{ request()->routeIs('admin.crm.estimations') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="apps-crm-estimations">Estimations</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.crm.customers') }}" class="side-nav-link {{ request()->routeIs('admin.crm.customers') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="apps-crm-customers">Customers</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.crm.activities') }}" class="side-nav-link {{ request()->routeIs('admin.crm.activities') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="apps-crm-activities">Activities</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#users" aria-expanded="false" aria-controls="users"
                        class="side-nav-link">
                        <span class="menu-icon"><i class="ti ti-users"></i></span>
                        <span class="menu-text" data-lang="users">Users</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse {{ request()->routeIs('admin.users.*') ? 'show' : '' }}" id="users">
                        <ul class="sub-menu">
                            <li class="side-nav-item">
                                <a href="{{ route('admin.users.contacts') }}" class="side-nav-link {{ request()->routeIs('admin.users.contacts') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="apps-users-contacts">Contacts</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.users.profile') }}" class="side-nav-link {{ request()->routeIs('admin.users.profile') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="apps-users-profile">Profile</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.users.account-settings') }}" class="side-nav-link {{ request()->routeIs('admin.users.account-settings') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="apps-users-account-settings">Account
                                        Settings</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.users.roles') }}" class="side-nav-link {{ request()->routeIs('admin.users.roles') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="apps-users-roles">Roles</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.users.role-details') }}" class="side-nav-link {{ request()->routeIs('admin.users.role-details') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="apps-users-role-details">Role
                                        Details</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.users.permissions') }}" class="side-nav-link {{ request()->routeIs('admin.users.permissions') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="apps-users-permissions">Permissions</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#finance" aria-expanded="false" aria-controls="finance"
                        class="side-nav-link">
                        <span class="menu-icon"><i class="ti ti-wallet"></i></span>
                        <span class="menu-text" data-lang="finance">Finance</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse {{ request()->routeIs('admin.finance.*') ? 'show' : '' }}" id="finance">
                        <ul class="sub-menu">
                            <li class="side-nav-item">
                                <a data-bs-toggle="collapse" href="#expenses" aria-expanded="false"
                                    aria-controls="expenses" class="side-nav-link">
                                    <span class="menu-text" data-lang="expenses">Expenses</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse {{ request()->routeIs('admin.finance.expense*') ? 'show' : '' }}" id="expenses">
                                    <ul class="sub-menu">
                                        <li class="side-nav-item">
                                            <a href="{{ route('admin.finance.expenses') }}" class="side-nav-link {{ request()->routeIs('admin.finance.expenses') ? 'active' : '' }}">
                                                <span class="menu-text"
                                                    data-lang="apps-finance-expenses">Expenses</span>
                                            </a>
                                        </li>
                                        <li class="side-nav-item">
                                            <a href="{{ route('admin.finance.expense-category') }}" class="side-nav-link {{ request()->routeIs('admin.finance.expense-category') ? 'active' : '' }}">
                                                <span class="menu-text"
                                                    data-lang="apps-finance-expense-category">Expense
                                                    Category</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.finance.income') }}" class="side-nav-link {{ request()->routeIs('admin.finance.income') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="apps-finance-income">Income</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.finance.transactions') }}" class="side-nav-link {{ request()->routeIs('admin.finance.transactions') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="apps-finance-transactions">Transactions</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.finance.banks-cards') }}" class="side-nav-link {{ request()->routeIs('admin.finance.banks-cards') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="apps-finance-banks-cards">Banks &amp;
                                        Cards</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#hrm" aria-expanded="false" aria-controls="hrm"
                        class="side-nav-link">
                        <span class="menu-icon"><i class="ti ti-accessible"></i></span>
                        <span class="menu-text" data-lang="hrm">HRM</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse {{ request()->routeIs('admin.hrm.*') ? 'show' : '' }}" id="hrm">
                        <ul class="sub-menu">
                            <li class="side-nav-item">
                                <a data-bs-toggle="collapse" href="#staffs" aria-expanded="false"
                                    aria-controls="staffs" class="side-nav-link">
                                    <span class="menu-text" data-lang="staffs">Staffs</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse {{ request()->routeIs('admin.hrm.staff*') ? 'show' : '' }}" id="staffs">
                                    <ul class="sub-menu">
                                        <li class="side-nav-item">
                                            <a href="{{ route('admin.hrm.staffs') }}" class="side-nav-link {{ request()->routeIs('admin.hrm.staffs') ? 'active' : '' }}">
                                                <span class="menu-text" data-lang="apps-hrm-staffs">Staffs
                                                    List</span>
                                            </a>
                                        </li>
                                        <li class="side-nav-item">
                                            <a href="{{ route('admin.hrm.staff-profile') }}" class="side-nav-link {{ request()->routeIs('admin.hrm.staff-profile') ? 'active' : '' }}">
                                                <span class="menu-text" data-lang="apps-hrm-staff-profile">Staff
                                                    Profile</span>
                                            </a>
                                        </li>
                                        <li class="side-nav-item">
                                            <a href="{{ route('admin.hrm.staff-add') }}" class="side-nav-link {{ request()->routeIs('admin.hrm.staff-add') ? 'active' : '' }}">
                                                <span class="menu-text" data-lang="apps-hrm-staff-add">Add
                                                    Staffs</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.hrm.departments') }}" class="side-nav-link {{ request()->routeIs('admin.hrm.departments') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="apps-hrm-departments">Departments</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.hrm.attendance') }}" class="side-nav-link {{ request()->routeIs('admin.hrm.attendance') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="apps-hrm-attendance">Attendance</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a data-bs-toggle="collapse" href="#leaves" aria-expanded="false"
                                    aria-controls="leaves" class="side-nav-link">
                                    <span class="menu-text" data-lang="leaves">Leaves</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse {{ request()->routeIs('admin.hrm.leave*') ? 'show' : '' }}" id="leaves">
                                    <ul class="sub-menu">
                                        <li class="side-nav-item">
                                            <a href="{{ route('admin.hrm.leaves') }}" class="side-nav-link {{ request()->routeIs('admin.hrm.leaves') ? 'active' : '' }}">
                                                <span class="menu-text" data-lang="apps-hrm-leaves">Leaves</span>
                                            </a>
                                        </li>
                                        <li class="side-nav-item">
                                            <a href="{{ route('admin.hrm.leave-add') }}" class="side-nav-link {{ request()->routeIs('admin.hrm.leave-add') ? 'active' : '' }}">
                                                <span class="menu-text" data-lang="apps-hrm-leave-add">Add
                                                    Leave</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.hrm.holidays') }}" class="side-nav-link {{ request()->routeIs('admin.hrm.holidays') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="apps-hrm-holidays">Holidays</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.hrm.payroll') }}" class="side-nav-link {{ request()->routeIs('admin.hrm.payroll') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="apps-hrm-payroll">Payroll</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.hrm.create-salary-slip') }}" class="side-nav-link {{ request()->routeIs('admin.hrm.create-salary-slip') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="apps-hrm-create-salary-slip">Create
                                        Salary Slip</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#email" aria-expanded="false" aria-controls="email"
                        class="side-nav-link">
                        <span class="menu-icon"><i class="ti ti-mailbox"></i></span>
                        <span class="menu-text" data-lang="email">Email</span>
                        <span class="badge bg-danger text-white">New</span>
                    </a>
                    <div class="collapse {{ request()->routeIs('admin.mail.*') ? 'show' : '' }}" id="email">
                        <ul class="sub-menu">
                            <li class="side-nav-item">
                                <a href="{{ route('admin.mail.inbox') }}" class="side-nav-link {{ request()->routeIs('admin.mail.inbox') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="apps-email-inbox">Inbox</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.mail.details') }}" class="side-nav-link {{ request()->routeIs('admin.mail.details') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="apps-email-details">Details</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.mail.compose') }}" class="side-nav-link {{ request()->routeIs('admin.mail.compose') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="apps-email-compose">Compose</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#support-center" aria-expanded="false"
                        aria-controls="support-center" class="side-nav-link">
                        <span class="menu-icon"><i class="ti ti-headset"></i></span>
                        <span class="menu-text" data-lang="support-center">Support Center</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse {{ request()->routeIs('admin.support.*') ? 'show' : '' }}" id="support-center">
                        <ul class="sub-menu">
                            <li class="side-nav-item">
                                <a href="{{ route('admin.support.ticket-list') }}" class="side-nav-link {{ request()->routeIs('admin.support.ticket-list') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="apps-ticket-list">Ticket List</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.support.ticket-details') }}" class="side-nav-link {{ request()->routeIs('admin.support.ticket-details') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="apps-ticket-details">Ticket
                                        Details</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.support.ticket-create') }}" class="side-nav-link {{ request()->routeIs('admin.support.ticket-create') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="apps-ticket-create">New Ticket</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#promo" aria-expanded="false" aria-controls="promo"
                        class="side-nav-link">
                        <span class="menu-icon"><i class="ti ti-discount"></i></span>
                        <span class="menu-text" data-lang="promo">Promo</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse {{ request()->routeIs('admin.promo.*') ? 'show' : '' }}" id="promo">
                        <ul class="sub-menu">
                            <li class="side-nav-item">
                                <a href="{{ route('admin.promo.coupons') }}" class="side-nav-link {{ request()->routeIs('admin.promo.coupons') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="apps-promo-coupons">Coupons</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.promo.gift-cards') }}" class="side-nav-link {{ request()->routeIs('admin.promo.gift-cards') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="apps-promo-gift-cards">Gift Cards</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.promo.discounts') }}" class="side-nav-link {{ request()->routeIs('admin.promo.discounts') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="apps-promo-discounts">Discounts</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#more-apps" aria-expanded="false" aria-controls="more-apps"
                        class="side-nav-link">
                        <span class="menu-icon"><i class="ti ti-apps"></i></span>
                        <span class="menu-text" data-lang="more-apps">More Apps</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse {{ request()->routeIs('admin.apps.*') ? 'show' : '' }}" id="more-apps">
                        <ul class="sub-menu">
                            <li class="side-nav-item">
                                <a href="{{ route('admin.apps.social-feed') }}" class="side-nav-link {{ request()->routeIs('admin.apps.social-feed') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="apps-social-feed">Social Feed</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.apps.pro-ai') }}" class="side-nav-link {{ request()->routeIs('admin.apps.pro-ai') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="apps-pro-ai">Pro AI</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.apps.file-manager') }}" class="side-nav-link {{ request()->routeIs('admin.apps.file-manager') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="apps-file-manager">File Manager</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.apps.calendar') }}" class="side-nav-link {{ request()->routeIs('admin.apps.calendar') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="apps-calendar">Calendar</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.apps.companies') }}" class="side-nav-link {{ request()->routeIs('admin.apps.companies') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="apps-companies">Companies</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.apps.todo') }}" class="side-nav-link {{ request()->routeIs('admin.apps.todo') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="apps-todo">Todo</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.apps.pin-board') }}" class="side-nav-link {{ request()->routeIs('admin.apps.pin-board') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="apps-pin-board">Pin Board</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.apps.clients') }}" class="side-nav-link {{ request()->routeIs('admin.apps.clients') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="apps-clients">Clients</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.mail.outlook') }}" class="side-nav-link {{ request()->routeIs('admin.mail.outlook') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="apps-outlook">Outlook View</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.apps.vote-list') }}" class="side-nav-link {{ request()->routeIs('admin.apps.vote-list') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="apps-vote-list">Vote List</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.apps.issue-tracker') }}" class="side-nav-link {{ request()->routeIs('admin.apps.issue-tracker') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="apps-issue-tracker">Issue Tracker</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.apps.api-keys') }}" class="side-nav-link {{ request()->routeIs('admin.apps.api-keys') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="apps-api-keys">API Keys</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.apps.manage') }}" class="side-nav-link {{ request()->routeIs('admin.apps.manage') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="apps-manage">Manage Apps</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a data-bs-toggle="collapse" href="#blog" aria-expanded="false"
                                    aria-controls="blog" class="side-nav-link">
                                    <span class="menu-text" data-lang="blog">Blog</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse {{ request()->routeIs('admin.blog.*') ? 'show' : '' }}" id="blog">
                                    <ul class="sub-menu">
                                        <li class="side-nav-item">
                                            <a href="{{ route('admin.blog.list') }}" class="side-nav-link {{ request()->routeIs('admin.blog.list') ? 'active' : '' }}">
                                                <span class="menu-text" data-lang="apps-blog-list">Blog
                                                    List</span>
                                            </a>
                                        </li>
                                        <li class="side-nav-item">
                                            <a href="{{ route('admin.blog.grid') }}" class="side-nav-link {{ request()->routeIs('admin.blog.grid') ? 'active' : '' }}">
                                                <span class="menu-text" data-lang="apps-blog-grid">Blog
                                                    Grid</span>
                                            </a>
                                        </li>
                                        <li class="side-nav-item">
                                            <a href="{{ route('admin.blog.article') }}" class="side-nav-link {{ request()->routeIs('admin.blog.article') ? 'active' : '' }}">
                                                <span class="menu-text" data-lang="apps-blog-article">Article</span>
                                            </a>
                                        </li>
                                        <li class="side-nav-item">
                                            <a href="{{ route('admin.blog.add') }}" class="side-nav-link {{ request()->routeIs('admin.blog.add') ? 'active' : '' }}">
                                                <span class="menu-text" data-lang="apps-blog-add">Add
                                                    Article</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="side-nav-item">
                                <a data-bs-toggle="collapse" href="#forum" aria-expanded="false"
                                    aria-controls="forum" class="side-nav-link">
                                    <span class="menu-text" data-lang="forum">Forum</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse {{ request()->routeIs('admin.forum.*') ? 'show' : '' }}" id="forum">
                                    <ul class="sub-menu">
                                        <li class="side-nav-item">
                                            <a href="{{ route('admin.forum.view') }}" class="side-nav-link {{ request()->routeIs('admin.forum.view') ? 'active' : '' }}">
                                                <span class="menu-text" data-lang="apps-forum-view">Forum
                                                    View</span>
                                            </a>
                                        </li>
                                        <li class="side-nav-item">
                                            <a href="{{ route('admin.forum.post') }}" class="side-nav-link {{ request()->routeIs('admin.forum.post') ? 'active' : '' }}">
                                                <span class="menu-text" data-lang="apps-forum-post">Forum
                                                    Post</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="side-nav-title mt-2" data-lang="custom-pages">Custom Pages</li>
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#pages" aria-expanded="false" aria-controls="pages"
                        class="side-nav-link">
                        <span class="menu-icon"><i class="ti ti-files"></i></span>
                        <span class="menu-text" data-lang="pages">Pages</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse {{ request()->routeIs('admin.pages.*') ? 'show' : '' }}" id="pages">
                        <ul class="sub-menu">
                            <li class="side-nav-item">
                                <a href="{{ route('admin.pages.about-us') }}" class="side-nav-link {{ request()->routeIs('admin.pages.about-us') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="pages-about-us">About Us</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.pages.contact-us') }}" class="side-nav-link {{ request()->routeIs('admin.pages.contact-us') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="pages-contact-us">Contact Us</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.pages.pricing') }}" class="side-nav-link {{ request()->routeIs('admin.pages.pricing') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="pages-pricing">Pricing</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.pages.empty') }}" class="side-nav-link {{ request()->routeIs('admin.pages.empty') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="pages-empty">Empty Page</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.pages.timeline') }}" class="side-nav-link {{ request()->routeIs('admin.pages.timeline') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="pages-timeline">Timeline</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.pages.gallery') }}" class="side-nav-link {{ request()->routeIs('admin.pages.gallery') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="pages-gallery">Gallery</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.pages.faq') }}" class="side-nav-link {{ request()->routeIs('admin.pages.faq') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="pages-faq">FAQ</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.pages.sitemap') }}" class="side-nav-link {{ request()->routeIs('admin.pages.sitemap') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="pages-sitemap">Sitemap</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.pages.search-results') }}" class="side-nav-link {{ request()->routeIs('admin.pages.search-results') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="pages-search-results">Search
                                        Results</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.pages.coming-soon') }}" class="side-nav-link {{ request()->routeIs('admin.pages.coming-soon') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="pages-coming-soon">Coming Soon</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.pages.privacy-policy') }}" class="side-nav-link {{ request()->routeIs('admin.pages.privacy-policy') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="pages-privacy-policy">Privacy
                                        Policy</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.pages.terms-conditions') }}" class="side-nav-link {{ request()->routeIs('admin.pages.terms-conditions') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="pages-terms-conditions">Terms &amp;
                                        Conditions</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#plugins" aria-expanded="false" aria-controls="plugins"
                        class="side-nav-link">
                        <span class="menu-icon"><i class="ti ti-cpu"></i></span>
                        <span class="menu-text" data-lang="plugins">Plugins</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse {{ request()->routeIs('admin.plugins.*') ? 'show' : '' }}" id="plugins">
                        <ul class="sub-menu">
                            <li class="side-nav-item">
                                <a href="{{ route('admin.plugins.sortable') }}" class="side-nav-link {{ request()->routeIs('admin.plugins.sortable') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="plugins-sortable">Sortable List</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.plugins.pdf-viewer') }}" class="side-nav-link {{ request()->routeIs('admin.plugins.pdf-viewer') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="plugins-pdf-viewer">PDF Viewer</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.plugins.i18') }}" class="side-nav-link {{ request()->routeIs('admin.plugins.i18') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="plugins-i18">i18 Support</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.plugins.sweet-alerts') }}" class="side-nav-link {{ request()->routeIs('admin.plugins.sweet-alerts') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="plugins-sweet-alerts">Sweet Alerts</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.plugins.idle-timer') }}" class="side-nav-link {{ request()->routeIs('admin.plugins.idle-timer') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="plugins-idle-timer">Idle Timer</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.plugins.pass-meter') }}" class="side-nav-link {{ request()->routeIs('admin.plugins.pass-meter') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="plugins-pass-meter">Password Meter</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.plugins.clipboard') }}" class="side-nav-link {{ request()->routeIs('admin.plugins.clipboard') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="plugins-clipboard">Clipboard</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.plugins.tree-view') }}" class="side-nav-link {{ request()->routeIs('admin.plugins.tree-view') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="plugins-tree-view">Tree View</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.plugins.masonry') }}" class="side-nav-link {{ request()->routeIs('admin.plugins.masonry') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="plugins-masonry">Masonry</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.plugins.tour') }}" class="side-nav-link {{ request()->routeIs('admin.plugins.tour') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="plugins-tour">Tour</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.plugins.animation') }}" class="side-nav-link {{ request()->routeIs('admin.plugins.animation') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="plugins-animation">Animation</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.plugins.video-player') }}" class="side-nav-link {{ request()->routeIs('admin.plugins.video-player') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="plugins-video-player">Video Player</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="side-nav-item">
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#error-pages" aria-expanded="false"
                        aria-controls="error-pages" class="side-nav-link">
                        <span class="menu-icon"><i class="ti ti-alert-triangle"></i></span>
                        <span class="menu-text" data-lang="error-pages">Error Pages</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse {{ request()->routeIs('admin.errors.*') ? 'show' : '' }}" id="error-pages">
                        <ul class="sub-menu">
                            <li class="side-nav-item">
                                <a href="{{ route('admin.errors.400') }}" class="side-nav-link {{ request()->routeIs('admin.errors.400') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="error-400">400 Bad Request</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.errors.401') }}" class="side-nav-link {{ request()->routeIs('admin.errors.401') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="error-401">401 Unauthorized</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.errors.403') }}" class="side-nav-link {{ request()->routeIs('admin.errors.403') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="error-403">403 Forbidden</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.errors.404') }}" class="side-nav-link {{ request()->routeIs('admin.errors.404') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="error-404">404 Not Found</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.errors.408') }}" class="side-nav-link {{ request()->routeIs('admin.errors.408') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="error-408">408 Request Timeout</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.errors.500') }}" class="side-nav-link {{ request()->routeIs('admin.errors.500') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="error-500">500 Internal Server</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.errors.maintenance') }}" class="side-nav-link {{ request()->routeIs('admin.errors.maintenance') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="error-maintenance">Maintenance</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="side-nav-title mt-2" data-lang="layouts">Layouts</li>
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#layout-options" aria-expanded="false"
                        aria-controls="layout-options" class="side-nav-link">
                        <span class="menu-icon"><i class="ti ti-layout"></i></span>
                        <span class="menu-text" data-lang="layout-options">Layout Options</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse {{ request()->routeIs('admin.layouts.*') ? 'show' : '' }}" id="layout-options">
                        <ul class="sub-menu">
                            <li class="side-nav-item">
                                <a href="{{ route('admin.layouts.horizontal') }}" class="side-nav-link {{ request()->routeIs('admin.layouts.horizontal') ? 'active' : '' }}" target="_blank">
                                    <span class="menu-text" data-lang="layouts-horizontal">Horizontal</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.layouts.boxed') }}" class="side-nav-link {{ request()->routeIs('admin.layouts.boxed') ? 'active' : '' }}" target="_blank">
                                    <span class="menu-text" data-lang="layouts-boxed">Boxed</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.layouts.scrollable') }}" class="side-nav-link {{ request()->routeIs('admin.layouts.scrollable') ? 'active' : '' }}" target="_blank">
                                    <span class="menu-text" data-lang="layouts-scrollable">Scrollable</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.layouts.compact') }}" class="side-nav-link {{ request()->routeIs('admin.layouts.compact') ? 'active' : '' }}" target="_blank">
                                    <span class="menu-text" data-lang="layouts-compact">Compact</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.layouts.preloader') }}" class="side-nav-link {{ request()->routeIs('admin.layouts.preloader') ? 'active' : '' }}" target="_blank">
                                    <span class="menu-text" data-lang="layouts-preloader">Preloader</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#sidebars" aria-expanded="false" aria-controls="sidebars"
                        class="side-nav-link">
                        <span class="menu-icon"><i class="ti ti-layout-sidebar-inactive"></i></span>
                        <span class="menu-text" data-lang="sidebars">Sidebars</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebars">
                        <ul class="sub-menu">
                            <li class="side-nav-item">
                                <a href="{{ route('admin.layouts.sidebar-light') }}" class="side-nav-link {{ request()->routeIs('admin.layouts.sidebar-light') ? 'active' : '' }}" target="_blank">
                                    <span class="menu-text" data-lang="layouts-sidebar-light">Light Menu</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.layouts.sidebar-gradient') }}" class="side-nav-link {{ request()->routeIs('admin.layouts.sidebar-gradient') ? 'active' : '' }}" target="_blank">
                                    <span class="menu-text" data-lang="layouts-sidebar-gradient">Gradient
                                        Menu</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.layouts.sidebar-gray') }}" class="side-nav-link {{ request()->routeIs('admin.layouts.sidebar-gray') ? 'active' : '' }}" target="_blank">
                                    <span class="menu-text" data-lang="layouts-sidebar-gray">Gray Menu</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.layouts.sidebar-image') }}" class="side-nav-link {{ request()->routeIs('admin.layouts.sidebar-image') ? 'active' : '' }}" target="_blank">
                                    <span class="menu-text" data-lang="layouts-sidebar-image">Image Menu</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.layouts.sidebar-compact') }}" class="side-nav-link {{ request()->routeIs('admin.layouts.sidebar-compact') ? 'active' : '' }}" target="_blank">
                                    <span class="menu-text" data-lang="layouts-sidebar-compact">Compact
                                        Menu</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.layouts.sidebar-on-hover') }}" class="side-nav-link {{ request()->routeIs('admin.layouts.sidebar-on-hover') ? 'active' : '' }}" target="_blank">
                                    <span class="menu-text" data-lang="layouts-sidebar-on-hover">On Hover
                                        Menu</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.layouts.sidebar-offcanvas') }}" class="side-nav-link {{ request()->routeIs('admin.layouts.sidebar-offcanvas') ? 'active' : '' }}" target="_blank">
                                    <span class="menu-text" data-lang="layouts-sidebar-offcanvas">Offcanvas
                                        Menu</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.layouts.sidebar-no-icons') }}" class="side-nav-link {{ request()->routeIs('admin.layouts.sidebar-no-icons') ? 'active' : '' }}" target="_blank">
                                    <span class="menu-text" data-lang="layouts-sidebar-no-icons">No Icons with
                                        Lines</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.layouts.sidebar-with-lines') }}" class="side-nav-link {{ request()->routeIs('admin.layouts.sidebar-with-lines') ? 'active' : '' }}" target="_blank">
                                    <span class="menu-text" data-lang="layouts-sidebar-with-lines">Sidebar with
                                        Lines</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#topbar" aria-expanded="false" aria-controls="topbar"
                        class="side-nav-link">
                        <span class="menu-icon"><i class="ti ti-layout-bottombar"></i></span>
                        <span class="menu-text" data-lang="topbar">Topbar</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="topbar">
                        <ul class="sub-menu">
                            <li class="side-nav-item">
                                <a href="{{ route('admin.layouts.topbar-dark') }}" class="side-nav-link {{ request()->routeIs('admin.layouts.topbar-dark') ? 'active' : '' }}" target="_blank">
                                    <span class="menu-text" data-lang="layouts-topbar-dark">Dark Topbar</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.layouts.topbar-gray') }}" class="side-nav-link {{ request()->routeIs('admin.layouts.topbar-gray') ? 'active' : '' }}" target="_blank">
                                    <span class="menu-text" data-lang="layouts-topbar-gray">Gray Topbar</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.layouts.topbar-gradient') }}" class="side-nav-link {{ request()->routeIs('admin.layouts.topbar-gradient') ? 'active' : '' }}" target="_blank">
                                    <span class="menu-text" data-lang="layouts-topbar-gradient">Gradient
                                        Topbar</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="side-nav-title mt-2" data-lang="components">Components</li>
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#base-ui" aria-expanded="false" aria-controls="base-ui"
                        class="side-nav-link">
                        <span class="menu-icon"><i class="ti ti-components"></i></span>
                        <span class="menu-text" data-lang="base-ui">Base UI</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse {{ request()->routeIs('admin.ui.*') ? 'show' : '' }}" id="base-ui">
                        <ul class="sub-menu">
                            <li class="side-nav-item">
                                <a href="{{ route('admin.ui.accordions') }}" class="side-nav-link {{ request()->routeIs('admin.ui.accordions') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="ui-accordions">Accordions</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.ui.alerts') }}" class="side-nav-link {{ request()->routeIs('admin.ui.alerts') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="ui-alerts">Alerts</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.ui.buttons') }}" class="side-nav-link {{ request()->routeIs('admin.ui.buttons') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="ui-buttons">Buttons</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.ui.badges') }}" class="side-nav-link {{ request()->routeIs('admin.ui.badges') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="ui-badges">Badges</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.ui.colors') }}" class="side-nav-link {{ request()->routeIs('admin.ui.colors') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="ui-colors">Colors</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.ui.breadcrumb') }}" class="side-nav-link {{ request()->routeIs('admin.ui.breadcrumb') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="ui-breadcrumb">Breadcrumb</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.ui.cards') }}" class="side-nav-link {{ request()->routeIs('admin.ui.cards') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="ui-cards">Cards</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.ui.carousel') }}" class="side-nav-link {{ request()->routeIs('admin.ui.carousel') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="ui-carousel">Carousel</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.ui.collapse') }}" class="side-nav-link {{ request()->routeIs('admin.ui.collapse') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="ui-collapse">Collapse</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.ui.images') }}" class="side-nav-link {{ request()->routeIs('admin.ui.images') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="ui-images">Images</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.ui.dropdowns') }}" class="side-nav-link {{ request()->routeIs('admin.ui.dropdowns') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="ui-dropdowns">Dropdowns</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.ui.videos') }}" class="side-nav-link {{ request()->routeIs('admin.ui.videos') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="ui-videos">Videos</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.ui.grid') }}" class="side-nav-link {{ request()->routeIs('admin.ui.grid') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="ui-grid">Grid Options</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.ui.links') }}" class="side-nav-link {{ request()->routeIs('admin.ui.links') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="ui-links">Links</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.ui.list-group') }}" class="side-nav-link {{ request()->routeIs('admin.ui.list-group') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="ui-list-group">List Group</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.ui.modals') }}" class="side-nav-link {{ request()->routeIs('admin.ui.modals') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="ui-modals">Modals</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.ui.notifications') }}" class="side-nav-link {{ request()->routeIs('admin.ui.notifications') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="ui-notifications">Notifications</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.ui.offcanvas') }}" class="side-nav-link {{ request()->routeIs('admin.ui.offcanvas') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="ui-offcanvas">Offcanvas</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.ui.placeholders') }}" class="side-nav-link {{ request()->routeIs('admin.ui.placeholders') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="ui-placeholders">Placeholders</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.ui.pagination') }}" class="side-nav-link {{ request()->routeIs('admin.ui.pagination') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="ui-pagination">Pagination</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.ui.popovers') }}" class="side-nav-link {{ request()->routeIs('admin.ui.popovers') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="ui-popovers">Popovers</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.ui.progress') }}" class="side-nav-link {{ request()->routeIs('admin.ui.progress') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="ui-progress">Progress</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.ui.scrollspy') }}" class="side-nav-link {{ request()->routeIs('admin.ui.scrollspy') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="ui-scrollspy">Scrollspy</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.ui.spinners') }}" class="side-nav-link {{ request()->routeIs('admin.ui.spinners') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="ui-spinners">Spinners</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.ui.tabs') }}" class="side-nav-link {{ request()->routeIs('admin.ui.tabs') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="ui-tabs">Tabs</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.ui.tooltips') }}" class="side-nav-link {{ request()->routeIs('admin.ui.tooltips') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="ui-tooltips">Tooltips</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.ui.typography') }}" class="side-nav-link {{ request()->routeIs('admin.ui.typography') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="ui-typography">Typography</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.ui.utilities') }}" class="side-nav-link {{ request()->routeIs('admin.ui.utilities') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="ui-utilities">Utilities</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#widgets" aria-expanded="false" aria-controls="widgets"
                        class="side-nav-link">
                        <span class="menu-icon"><i class="ti ti-category"></i></span>
                        <span class="menu-text" data-lang="widgets">Widgets</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse {{ request()->routeIs('admin.widgets.*') ? 'show' : '' }}" id="widgets">
                        <ul class="sub-menu">
                            <li class="side-nav-item">
                                <a href="{{ route('admin.widgets.charts') }}" class="side-nav-link {{ request()->routeIs('admin.widgets.charts') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="widgets-charts">Charts</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.widgets.mixed') }}" class="side-nav-link {{ request()->routeIs('admin.widgets.mixed') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="widgets-mixed">Mixed</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.widgets.social') }}" class="side-nav-link {{ request()->routeIs('admin.widgets.social') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="widgets-social">Social</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.widgets.statistics') }}" class="side-nav-link {{ request()->routeIs('admin.widgets.statistics') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="widgets-statistics">Statistics</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.widgets.weather') }}" class="side-nav-link {{ request()->routeIs('admin.widgets.weather') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="widgets-weather">Weather</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#charts" aria-expanded="false" aria-controls="charts"
                        class="side-nav-link">
                        <span class="menu-icon"><i class="ti ti-chart-donut"></i></span>
                        <span class="menu-text" data-lang="charts">Charts</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse {{ request()->routeIs('admin.charts.*') ? 'show' : '' }}" id="charts">
                        <ul class="sub-menu">
                            <li class="side-nav-item">
                                <a data-bs-toggle="collapse" href="#apex-charts" aria-expanded="false"
                                    aria-controls="apex-charts" class="side-nav-link">
                                    <span class="menu-text" data-lang="apex-charts">Apex Charts</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse {{ request()->routeIs('admin.charts.apex-*') ? 'show' : '' }}" id="apex-charts">
                                    <ul class="sub-menu">
                                        <li class="side-nav-item">
                                            <a href="{{ route('admin.charts.apex-area') }}" class="side-nav-link {{ request()->routeIs('admin.charts.apex-area') ? 'active' : '' }}">
                                                <span class="menu-text" data-lang="charts-apex-area">Area</span>
                                            </a>
                                        </li>
                                        <li class="side-nav-item">
                                            <a href="{{ route('admin.charts.apex-bar') }}" class="side-nav-link {{ request()->routeIs('admin.charts.apex-bar') ? 'active' : '' }}">
                                                <span class="menu-text" data-lang="charts-apex-bar">Bar</span>
                                            </a>
                                        </li>
                                        <li class="side-nav-item">
                                            <a href="{{ route('admin.charts.apex-bubble') }}" class="side-nav-link {{ request()->routeIs('admin.charts.apex-bubble') ? 'active' : '' }}">
                                                <span class="menu-text" data-lang="charts-apex-bubble">Bubble</span>
                                            </a>
                                        </li>
                                        <li class="side-nav-item">
                                            <a href="{{ route('admin.charts.apex-candlestick') }}" class="side-nav-link {{ request()->routeIs('admin.charts.apex-candlestick') ? 'active' : '' }}">
                                                <span class="menu-text"
                                                    data-lang="charts-apex-candlestick">Candlestick</span>
                                            </a>
                                        </li>
                                        <li class="side-nav-item">
                                            <a href="{{ route('admin.charts.apex-column') }}" class="side-nav-link {{ request()->routeIs('admin.charts.apex-column') ? 'active' : '' }}">
                                                <span class="menu-text" data-lang="charts-apex-column">Column</span>
                                            </a>
                                        </li>
                                        <li class="side-nav-item">
                                            <a href="{{ route('admin.charts.apex-heatmap') }}" class="side-nav-link {{ request()->routeIs('admin.charts.apex-heatmap') ? 'active' : '' }}">
                                                <span class="menu-text"
                                                    data-lang="charts-apex-heatmap">Heatmap</span>
                                            </a>
                                        </li>
                                        <li class="side-nav-item">
                                            <a href="{{ route('admin.charts.apex-line') }}" class="side-nav-link {{ request()->routeIs('admin.charts.apex-line') ? 'active' : '' }}">
                                                <span class="menu-text" data-lang="charts-apex-line">Line</span>
                                            </a>
                                        </li>
                                        <li class="side-nav-item">
                                            <a href="{{ route('admin.charts.apex-mixed') }}" class="side-nav-link {{ request()->routeIs('admin.charts.apex-mixed') ? 'active' : '' }}">
                                                <span class="menu-text" data-lang="charts-apex-mixed">Mixed</span>
                                            </a>
                                        </li>
                                        <li class="side-nav-item">
                                            <a href="{{ route('admin.charts.apex-timeline') }}" class="side-nav-link {{ request()->routeIs('admin.charts.apex-timeline') ? 'active' : '' }}">
                                                <span class="menu-text"
                                                    data-lang="charts-apex-timeline">Timeline</span>
                                            </a>
                                        </li>
                                        <li class="side-nav-item">
                                            <a href="{{ route('admin.charts.apex-boxplot') }}" class="side-nav-link {{ request()->routeIs('admin.charts.apex-boxplot') ? 'active' : '' }}">
                                                <span class="menu-text"
                                                    data-lang="charts-apex-boxplot">Boxplot</span>
                                            </a>
                                        </li>
                                        <li class="side-nav-item">
                                            <a href="{{ route('admin.charts.apex-treemap') }}" class="side-nav-link {{ request()->routeIs('admin.charts.apex-treemap') ? 'active' : '' }}">
                                                <span class="menu-text"
                                                    data-lang="charts-apex-treemap">Treemap</span>
                                            </a>
                                        </li>
                                        <li class="side-nav-item">
                                            <a href="{{ route('admin.charts.apex-pie') }}" class="side-nav-link {{ request()->routeIs('admin.charts.apex-pie') ? 'active' : '' }}">
                                                <span class="menu-text" data-lang="charts-apex-pie">Pie</span>
                                            </a>
                                        </li>
                                        <li class="side-nav-item">
                                            <a href="{{ route('admin.charts.apex-radar') }}" class="side-nav-link {{ request()->routeIs('admin.charts.apex-radar') ? 'active' : '' }}">
                                                <span class="menu-text" data-lang="charts-apex-radar">Radar</span>
                                            </a>
                                        </li>
                                        <li class="side-nav-item">
                                            <a href="{{ route('admin.charts.apex-radialbar') }}" class="side-nav-link {{ request()->routeIs('admin.charts.apex-radialbar') ? 'active' : '' }}">
                                                <span class="menu-text"
                                                    data-lang="charts-apex-radialbar">RadialBar</span>
                                            </a>
                                        </li>
                                        <li class="side-nav-item">
                                            <a href="{{ route('admin.charts.apex-scatter') }}" class="side-nav-link {{ request()->routeIs('admin.charts.apex-scatter') ? 'active' : '' }}">
                                                <span class="menu-text"
                                                    data-lang="charts-apex-scatter">Scatter</span>
                                            </a>
                                        </li>
                                        <li class="side-nav-item">
                                            <a href="{{ route('admin.charts.apex-polar-area') }}" class="side-nav-link {{ request()->routeIs('admin.charts.apex-polar-area') ? 'active' : '' }}">
                                                <span class="menu-text" data-lang="charts-apex-polar-area">Polar
                                                    Area</span>
                                            </a>
                                        </li>
                                        <li class="side-nav-item">
                                            <a href="{{ route('admin.charts.apex-sparklines') }}" class="side-nav-link {{ request()->routeIs('admin.charts.apex-sparklines') ? 'active' : '' }}">
                                                <span class="menu-text"
                                                    data-lang="charts-apex-sparklines">Sparklines</span>
                                            </a>
                                        </li>
                                        <li class="side-nav-item">
                                            <a href="{{ route('admin.charts.apex-range') }}" class="side-nav-link {{ request()->routeIs('admin.charts.apex-range') ? 'active' : '' }}">
                                                <span class="menu-text" data-lang="charts-apex-range">Range</span>
                                            </a>
                                        </li>
                                        <li class="side-nav-item">
                                            <a href="{{ route('admin.charts.apex-funnel') }}" class="side-nav-link {{ request()->routeIs('admin.charts.apex-funnel') ? 'active' : '' }}">
                                                <span class="menu-text" data-lang="charts-apex-funnel">Funnel</span>
                                            </a>
                                        </li>
                                        <li class="side-nav-item">
                                            <a href="{{ route('admin.charts.apex-slope') }}" class="side-nav-link {{ request()->routeIs('admin.charts.apex-slope') ? 'active' : '' }}">
                                                <span class="menu-text" data-lang="charts-apex-slope">Slope</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="side-nav-item">
                                <a data-bs-toggle="collapse" href="#echarts" aria-expanded="false"
                                    aria-controls="echarts" class="side-nav-link">
                                    <span class="menu-text" data-lang="echarts">Echarts</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="echarts">
                                    <ul class="sub-menu">
                                        <li class="side-nav-item">
                                            <a href="{{ route('admin.charts.echart-line') }}" class="side-nav-link {{ request()->routeIs('admin.charts.echart-line') ? 'active' : '' }}">
                                                <span class="menu-text" data-lang="charts-echart-line">Line</span>
                                            </a>
                                        </li>
                                        <li class="side-nav-item">
                                            <a href="{{ route('admin.charts.echart-bar') }}" class="side-nav-link {{ request()->routeIs('admin.charts.echart-bar') ? 'active' : '' }}">
                                                <span class="menu-text" data-lang="charts-echart-bar">Bar</span>
                                            </a>
                                        </li>
                                        <li class="side-nav-item">
                                            <a href="{{ route('admin.charts.echart-pie') }}" class="side-nav-link {{ request()->routeIs('admin.charts.echart-pie') ? 'active' : '' }}">
                                                <span class="menu-text" data-lang="charts-echart-pie">Pie</span>
                                            </a>
                                        </li>
                                        <li class="side-nav-item">
                                            <a href="{{ route('admin.charts.echart-scatter') }}" class="side-nav-link {{ request()->routeIs('admin.charts.echart-scatter') ? 'active' : '' }}">
                                                <span class="menu-text"
                                                    data-lang="charts-echart-scatter">Scatter</span>
                                            </a>
                                        </li>
                                        <li class="side-nav-item">
                                            <a href="{{ route('admin.charts.echart-geo-map') }}" class="side-nav-link {{ request()->routeIs('admin.charts.echart-geo-map') ? 'active' : '' }}">
                                                <span class="menu-text" data-lang="charts-echart-geo-map">GEO
                                                    Map</span>
                                            </a>
                                        </li>
                                        <li class="side-nav-item">
                                            <a href="{{ route('admin.charts.echart-gauge') }}" class="side-nav-link {{ request()->routeIs('admin.charts.echart-gauge') ? 'active' : '' }}">
                                                <span class="menu-text" data-lang="charts-echart-gauge">Gauge</span>
                                            </a>
                                        </li>
                                        <li class="side-nav-item">
                                            <a href="{{ route('admin.charts.echart-candlestick') }}" class="side-nav-link {{ request()->routeIs('admin.charts.echart-candlestick') ? 'active' : '' }}">
                                                <span class="menu-text"
                                                    data-lang="charts-echart-candlestick">Candlestick</span>
                                            </a>
                                        </li>
                                        <li class="side-nav-item">
                                            <a href="{{ route('admin.charts.echart-area') }}" class="side-nav-link {{ request()->routeIs('admin.charts.echart-area') ? 'active' : '' }}">
                                                <span class="menu-text" data-lang="charts-echart-area">Area</span>
                                            </a>
                                        </li>
                                        <li class="side-nav-item">
                                            <a href="{{ route('admin.charts.echart-radar') }}" class="side-nav-link {{ request()->routeIs('admin.charts.echart-radar') ? 'active' : '' }}">
                                                <span class="menu-text" data-lang="charts-echart-radar">Radar</span>
                                            </a>
                                        </li>
                                        <li class="side-nav-item">
                                            <a href="{{ route('admin.charts.echart-heatmap') }}" class="side-nav-link {{ request()->routeIs('admin.charts.echart-heatmap') ? 'active' : '' }}">
                                                <span class="menu-text"
                                                    data-lang="charts-echart-heatmap">Heatmap</span>
                                            </a>
                                        </li>
                                        <li class="side-nav-item">
                                            <a href="{{ route('admin.charts.echart-other') }}" class="side-nav-link {{ request()->routeIs('admin.charts.echart-other') ? 'active' : '' }}">
                                                <span class="menu-text" data-lang="charts-echart-other">Other</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="side-nav-item">
                                <a data-bs-toggle="collapse" href="#chartjs" aria-expanded="false"
                                    aria-controls="chartjs" class="side-nav-link">
                                    <span class="menu-text" data-lang="chartjs">Chart Js</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse {{ request()->routeIs('admin.charts.chartjs-*') ? 'show' : '' }}" id="chartjs">
                                    <ul class="sub-menu">
                                        <li class="side-nav-item">
                                            <a href="{{ route('admin.charts.chartjs-area') }}" class="side-nav-link {{ request()->routeIs('admin.charts.chartjs-area') ? 'active' : '' }}">
                                                <span class="menu-text" data-lang="charts-chartjs-area">Area</span>
                                            </a>
                                        </li>
                                        <li class="side-nav-item">
                                            <a href="{{ route('admin.charts.chartjs-bar') }}" class="side-nav-link {{ request()->routeIs('admin.charts.chartjs-bar') ? 'active' : '' }}">
                                                <span class="menu-text" data-lang="charts-chartjs-bar">Bar</span>
                                            </a>
                                        </li>
                                        <li class="side-nav-item">
                                            <a href="{{ route('admin.charts.chartjs-line') }}" class="side-nav-link {{ request()->routeIs('admin.charts.chartjs-line') ? 'active' : '' }}">
                                                <span class="menu-text" data-lang="charts-chartjs-line">Line</span>
                                            </a>
                                        </li>
                                        <li class="side-nav-item">
                                            <a href="{{ route('admin.charts.chartjs-other') }}" class="side-nav-link {{ request()->routeIs('admin.charts.chartjs-other') ? 'active' : '' }}">
                                                <span class="menu-text"
                                                    data-lang="charts-chartjs-other">Other</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#forms" aria-expanded="false" aria-controls="forms"
                        class="side-nav-link">
                        <span class="menu-icon"><i class="ti ti-clipboard-list"></i></span>
                        <span class="menu-text" data-lang="forms">Forms</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse {{ request()->routeIs('admin.forms.*') ? 'show' : '' }}" id="forms">
                        <ul class="sub-menu">
                            <li class="side-nav-item">
                                <a href="{{ route('admin.forms.elements') }}" class="side-nav-link {{ request()->routeIs('admin.forms.elements') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="form-elements">Basic Elements</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.forms.validation') }}" class="side-nav-link {{ request()->routeIs('admin.forms.validation') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="form-validation">Validation</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.forms.wizard') }}" class="side-nav-link {{ request()->routeIs('admin.forms.wizard') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="form-wizard">Wizard</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.forms.select') }}" class="side-nav-link {{ request()->routeIs('admin.forms.select') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="form-select">Select</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.forms.pickers') }}" class="side-nav-link {{ request()->routeIs('admin.forms.pickers') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="form-pickers">Pickers</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.forms.fileuploads') }}" class="side-nav-link {{ request()->routeIs('admin.forms.fileuploads') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="form-fileuploads">File Uploads</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.forms.text-editors') }}" class="side-nav-link {{ request()->routeIs('admin.forms.text-editors') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="form-text-editors">Text Editors</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.forms.range-slider') }}" class="side-nav-link {{ request()->routeIs('admin.forms.range-slider') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="form-range-slider">Range Slider</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.forms.cropper') }}" class="side-nav-link {{ request()->routeIs('admin.forms.cropper') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="form-cropper">Image Cropper</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.forms.layout') }}" class="side-nav-link {{ request()->routeIs('admin.forms.layout') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="form-layout">Layouts</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.forms.other-plugin') }}" class="side-nav-link {{ request()->routeIs('admin.forms.other-plugin') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="form-other-plugin">Other Plugins</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#tables" aria-expanded="false" aria-controls="tables"
                        class="side-nav-link">
                        <span class="menu-icon"><i class="ti ti-table-column"></i></span>
                        <span class="menu-text" data-lang="tables">Tables</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse {{ request()->routeIs('admin.tables.*') ? 'show' : '' }}" id="tables">
                        <ul class="sub-menu">
                            <li class="side-nav-item">
                                <a href="{{ route('admin.tables.static') }}" class="side-nav-link {{ request()->routeIs('admin.tables.static') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="tables-static">Static Tables</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.tables.custom') }}" class="side-nav-link {{ request()->routeIs('admin.tables.custom') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="tables-custom">Custom Tables</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a data-bs-toggle="collapse" href="#datatables" aria-expanded="false"
                                    aria-controls="datatables" class="side-nav-link">
                                    <span class="menu-text" data-lang="datatables">DataTables</span>
                                    <span class="badge bg-success text-white">15</span>
                                </a>
                                <div class="collapse {{ request()->routeIs('admin.tables.datatables-*') ? 'show' : '' }}" id="datatables">
                                    <ul class="sub-menu">
                                        <li class="side-nav-item">
                                            <a href="{{ route('admin.tables.datatables-basic') }}" class="side-nav-link {{ request()->routeIs('admin.tables.datatables-basic') ? 'active' : '' }}">
                                                <span class="menu-text"
                                                    data-lang="tables-datatables-basic">Basic</span>
                                            </a>
                                        </li>
                                        <li class="side-nav-item">
                                            <a href="{{ route('admin.tables.datatables-export') }}" class="side-nav-link {{ request()->routeIs('admin.tables.datatables-export') ? 'active' : '' }}">
                                                <span class="menu-text"
                                                    data-lang="tables-datatables-export-data">Export Data</span>
                                            </a>
                                        </li>
                                        <li class="side-nav-item">
                                            <a href="{{ route('admin.tables.datatables-select') }}" class="side-nav-link {{ request()->routeIs('admin.tables.datatables-select') ? 'active' : '' }}">
                                                <span class="menu-text"
                                                    data-lang="tables-datatables-select">Select</span>
                                            </a>
                                        </li>
                                        <li class="side-nav-item">
                                            <a href="{{ route('admin.tables.datatables-ajax') }}" class="side-nav-link {{ request()->routeIs('admin.tables.datatables-ajax') ? 'active' : '' }}">
                                                <span class="menu-text"
                                                    data-lang="tables-datatables-ajax">Ajax</span>
                                            </a>
                                        </li>
                                        <li class="side-nav-item">
                                            <a href="{{ route('admin.tables.datatables-js') }}" class="side-nav-link {{ request()->routeIs('admin.tables.datatables-js') ? 'active' : '' }}">
                                                <span class="menu-text"
                                                    data-lang="tables-datatables-javascript">Javascript
                                                    Source</span>
                                            </a>
                                        </li>
                                        <li class="side-nav-item">
                                            <a href="{{ route('admin.tables.datatables-rendering') }}" class="side-nav-link {{ request()->routeIs('admin.tables.datatables-rendering') ? 'active' : '' }}">
                                                <span class="menu-text" data-lang="tables-datatables-rendering">Data
                                                    Rendering</span>
                                            </a>
                                        </li>
                                        <li class="side-nav-item">
                                            <a href="{{ route('admin.tables.datatables-scroll') }}" class="side-nav-link {{ request()->routeIs('admin.tables.datatables-scroll') ? 'active' : '' }}">
                                                <span class="menu-text"
                                                    data-lang="tables-datatables-scroll">Scroll</span>
                                            </a>
                                        </li>
                                        <li class="side-nav-item">
                                            <a href="{{ route('admin.tables.datatables-fixed-cols') }}" class="side-nav-link {{ request()->routeIs('admin.tables.datatables-fixed-cols') ? 'active' : '' }}">
                                                <span class="menu-text"
                                                    data-lang="tables-datatables-fixed-columns">Fixed
                                                    Columns</span>
                                            </a>
                                        </li>
                                        <li class="side-nav-item">
                                            <a href="{{ route('admin.tables.datatables-fixed-header') }}" class="side-nav-link {{ request()->routeIs('admin.tables.datatables-fixed-header') ? 'active' : '' }}">
                                                <span class="menu-text"
                                                    data-lang="tables-datatables-fixed-header">Fixed
                                                    Header</span>
                                            </a>
                                        </li>
                                        <li class="side-nav-item">
                                            <a href="{{ route('admin.tables.datatables-columns') }}" class="side-nav-link {{ request()->routeIs('admin.tables.datatables-columns') ? 'active' : '' }}">
                                                <span class="menu-text" data-lang="tables-datatables-columns">Show
                                                    &amp; Hide
                                                    Column</span>
                                            </a>
                                        </li>
                                        <li class="side-nav-item">
                                            <a href="{{ route('admin.tables.datatables-child-rows') }}" class="side-nav-link {{ request()->routeIs('admin.tables.datatables-child-rows') ? 'active' : '' }}">
                                                <span class="menu-text"
                                                    data-lang="tables-datatables-child-rows">Child Rows</span>
                                            </a>
                                        </li>
                                        <li class="side-nav-item">
                                            <a href="{{ route('admin.tables.datatables-col-searching') }}" class="side-nav-link {{ request()->routeIs('admin.tables.datatables-col-searching') ? 'active' : '' }}">
                                                <span class="menu-text"
                                                    data-lang="tables-datatables-column-searching">Column
                                                    Searching</span>
                                            </a>
                                        </li>
                                        <li class="side-nav-item">
                                            <a href="{{ route('admin.tables.datatables-range') }}" class="side-nav-link {{ request()->routeIs('admin.tables.datatables-range') ? 'active' : '' }}">
                                                <span class="menu-text"
                                                    data-lang="tables-datatables-range-search">Range
                                                    Search</span>
                                            </a>
                                        </li>
                                        <li class="side-nav-item">
                                            <a href="{{ route('admin.tables.datatables-rows-add') }}" class="side-nav-link {{ request()->routeIs('admin.tables.datatables-rows-add') ? 'active' : '' }}">
                                                <span class="menu-text" data-lang="tables-datatables-rows-add">Add
                                                    Rows</span>
                                            </a>
                                        </li>
                                        <li class="side-nav-item">
                                            <a href="{{ route('admin.tables.datatables-checkbox') }}" class="side-nav-link {{ request()->routeIs('admin.tables.datatables-checkbox') ? 'active' : '' }}">
                                                <span class="menu-text"
                                                    data-lang="tables-datatables-checkbox-select">Checkbox
                                                    Select</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#icons" aria-expanded="false" aria-controls="icons"
                        class="side-nav-link">
                        <span class="menu-icon"><i class="ti ti-icons"></i></span>
                        <span class="menu-text" data-lang="icons">Icons</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse {{ request()->routeIs('admin.icons.*') ? 'show' : '' }}" id="icons">
                        <ul class="sub-menu">
                            <li class="side-nav-item">
                                <a href="{{ route('admin.icons.tabler') }}" class="side-nav-link {{ request()->routeIs('admin.icons.tabler') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="icons-tabler">Tabler</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.icons.lucide') }}" class="side-nav-link {{ request()->routeIs('admin.icons.lucide') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="icons-lucide">Lucide</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.icons.remix') }}" class="side-nav-link {{ request()->routeIs('admin.icons.remix') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="icons-remix">Remix</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.icons.solar-duotone') }}" class="side-nav-link {{ request()->routeIs('admin.icons.solar-duotone') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="icons-solar-duotone">Solar Duotone</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.icons.flags') }}" class="side-nav-link {{ request()->routeIs('admin.icons.flags') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="icons-flags">Flags</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#maps" aria-expanded="false" aria-controls="maps"
                        class="side-nav-link">
                        <span class="menu-icon"><i class="ti ti-map"></i></span>
                        <span class="menu-text" data-lang="maps">Maps</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse {{ request()->routeIs('admin.maps.*') ? 'show' : '' }}" id="maps">
                        <ul class="sub-menu">
                            <li class="side-nav-item">
                                <a href="{{ route('admin.maps.google') }}" class="side-nav-link {{ request()->routeIs('admin.maps.google') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="maps-google">Google Maps</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.maps.vector') }}" class="side-nav-link {{ request()->routeIs('admin.maps.vector') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="maps-vector">Vector Maps</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{ route('admin.maps.leaflet') }}" class="side-nav-link {{ request()->routeIs('admin.maps.leaflet') ? 'active' : '' }}">
                                    <span class="menu-text" data-lang="maps-leaflet">Leaflet Maps</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="side-nav-title mt-2" data-lang="menu-items">Menu Items</li>
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#menu-levels" aria-expanded="false"
                        aria-controls="menu-levels" class="side-nav-link">
                        <span class="menu-icon"><i class="ti ti-sitemap"></i></span>
                        <span class="menu-text" data-lang="menu-levels">Menu Levels</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="menu-levels">
                        <ul class="sub-menu">
                            <li class="side-nav-item">
                                <a data-bs-toggle="collapse" href="#second-level" aria-expanded="false"
                                    aria-controls="second-level" class="side-nav-link">
                                    <span class="menu-text" data-lang="second-level">Second Level</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="second-level">
                                    <ul class="sub-menu">
                                        <li class="side-nav-item">
                                            <a href="#" class="side-nav-link">
                                                <span class="menu-text" data-lang="menu-item-1">Item 2.1</span>
                                            </a>
                                        </li>
                                        <li class="side-nav-item">
                                            <a href="#" class="side-nav-link">
                                                <span class="menu-text" data-lang="menu-item-2">Item 2.2</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="side-nav-item">
                                <a data-bs-toggle="collapse" href="#second-level-2" aria-expanded="false"
                                    aria-controls="second-level-2" class="side-nav-link">
                                    <span class="menu-text" data-lang="second-level-2">Second Level</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="second-level-2">
                                    <ul class="sub-menu">
                                        <li class="side-nav-item">
                                            <a href="#" class="side-nav-link">
                                                <span class="menu-text" data-lang="menu-item-3">Item 2.1</span>
                                            </a>
                                        </li>
                                        <li class="side-nav-item">
                                            <a data-bs-toggle="collapse" href="#menu-item-4" aria-expanded="false"
                                                aria-controls="menu-item-4" class="side-nav-link">
                                                <span class="menu-text" data-lang="menu-item-4">Item 2.2</span>
                                                <span class="menu-arrow"></span>
                                            </a>
                                            <div class="collapse" id="menu-item-4">
                                                <ul class="sub-menu">
                                                    <li class="side-nav-item">
                                                        <a href="#" class="side-nav-link">
                                                            <span class="menu-text" data-lang="menu-item-5">Item
                                                                3.1</span>
                                                        </a>
                                                    </li>
                                                    <li class="side-nav-item">
                                                        <a href="#" class="side-nav-link">
                                                            <span class="menu-text" data-lang="menu-item-6">Item
                                                                3.2</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="side-nav-item">
                    <a href="#" class="side-nav-link disabled">
                        <span class="menu-icon"><i class="ti ti-ban"></i></span>
                        <span class="menu-text" data-lang="disabled-menu">Disabled Menu</span>
                    </a>
                </li>
                <li class="side-nav-item">
                    <a href="#" class="side-nav-link special-menu">
                        <span class="menu-icon"><i class="ti ti-star"></i></span>
                        <span class="menu-text" data-lang="special-menu">Special Menu</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
