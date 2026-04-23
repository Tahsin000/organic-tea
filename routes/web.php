<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EcommerceController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\TaskController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\CrmController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\FinanceController;
use App\Http\Controllers\Admin\HrmController;
use App\Http\Controllers\Admin\MailController;
use App\Http\Controllers\Admin\SupportController;
use App\Http\Controllers\Admin\PromoController;
use App\Http\Controllers\Admin\AppsController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\ForumController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\LayoutController;
use App\Http\Controllers\Admin\ChartController;
use App\Http\Controllers\Admin\WidgetController;
use App\Http\Controllers\Admin\FormController;
use App\Http\Controllers\Admin\TableController;
use App\Http\Controllers\Admin\IconController;
use App\Http\Controllers\Admin\MapController;
use App\Http\Controllers\Admin\PluginController;
use App\Http\Controllers\Admin\UiController;
use App\Http\Controllers\Admin\ErrorController;

// Landing page route
Route::get('/', [LandingPageController::class, 'index'])->name('landing');

// Product page route
Route::get('/product/{productId}', [LandingPageController::class, 'product'])->name('product');

// Checkout routes
Route::get('/checkout', [OrderController::class, 'create'])->name('checkout');
Route::post('/checkout', [OrderController::class, 'store'])->name('checkout.store')->middleware('throttle:10,1');

// Admin Auth Routes (outside admin prefix - login page)
Route::get('/admin/auth/sign-in', [AuthController::class, 'signIn'])->name('admin.auth.sign-in');
Route::post('/admin/auth/login', [AuthController::class, 'login'])->name('admin.auth.login');
Route::post('/admin/auth/logout', [AuthController::class, 'logout'])->name('admin.auth.logout');

// Protected Admin Routes
Route::prefix('admin')->name('admin.')->middleware('admin.auth')->group(function () {

    // ─── Dashboard ───────────────────────────────────────────────────────────
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/',          [DashboardController::class, 'ecommerce'])->name('ecommerce');
        Route::get('/analytics', [DashboardController::class, 'analytics'])->name('analytics');
        Route::get('/crm',       [DashboardController::class, 'crm'])->name('crm');
        Route::get('/finance',   [DashboardController::class, 'finance'])->name('finance');
        Route::get('/projects',  [DashboardController::class, 'projects'])->name('projects');
    });

    // ─── Ecommerce ───────────────────────────────────────────────────────────
    Route::prefix('ecommerce')->name('ecommerce.')->group(function () {
        Route::get('/products',          [EcommerceController::class, 'products'])->name('products');
        Route::get('/products/grid',     [EcommerceController::class, 'productsGrid'])->name('products-grid');
        Route::get('/products/details',  [EcommerceController::class, 'productDetails'])->name('product-details');
        Route::get('/products/add',      [EcommerceController::class, 'productAdd'])->name('product-add');
        Route::get('/categories',        [EcommerceController::class, 'categories'])->name('categories');
        Route::get('/orders',            [EcommerceController::class, 'orders'])->name('orders');
        Route::get('/orders/details',    [EcommerceController::class, 'orderDetails'])->name('order-details');
        Route::get('/orders/add',        [EcommerceController::class, 'orderAdd'])->name('order-add');
        Route::get('/customers',         [EcommerceController::class, 'customers'])->name('customers');
        Route::get('/cart',              [EcommerceController::class, 'cart'])->name('cart');
        Route::get('/checkout',          [EcommerceController::class, 'checkout'])->name('checkout');
        Route::get('/sellers',           [EcommerceController::class, 'sellers'])->name('sellers');
        Route::get('/sellers/details',   [EcommerceController::class, 'sellerDetails'])->name('seller-details');
        Route::get('/refunds',           [EcommerceController::class, 'refunds'])->name('refunds');
        Route::get('/reviews',           [EcommerceController::class, 'reviews'])->name('reviews');
        Route::get('/warehouse',         [EcommerceController::class, 'warehouse'])->name('warehouse');
        Route::get('/stocks',            [EcommerceController::class, 'stocks'])->name('product-stocks');
        Route::get('/purchased-orders',  [EcommerceController::class, 'purchasedOrders'])->name('purchased-orders');
        Route::get('/product-views',     [EcommerceController::class, 'productViews'])->name('product-views');
        Route::get('/sales',             [EcommerceController::class, 'sales'])->name('sales');
        Route::get('/attributes',        [EcommerceController::class, 'attributes'])->name('attributes');
        Route::get('/discount-edit',     [EcommerceController::class, 'discountEdit'])->name('discount-edit');
        Route::get('/settings',          [EcommerceController::class, 'settings'])->name('settings');
    });

    // ─── Projects ────────────────────────────────────────────────────────────
    Route::prefix('projects')->name('projects.')->group(function () {
        Route::get('/grid',       [ProjectController::class, 'grid'])->name('grid');
        Route::get('/list',       [ProjectController::class, 'list'])->name('list');
        Route::get('/details',    [ProjectController::class, 'details'])->name('details');
        Route::get('/kanban',     [ProjectController::class, 'kanban'])->name('kanban');
        Route::get('/team-board', [ProjectController::class, 'teamBoard'])->name('team-board');
        Route::get('/activity',   [ProjectController::class, 'activity'])->name('activity');
    });

    // ─── Tasks ───────────────────────────────────────────────────────────────
    Route::prefix('tasks')->name('tasks.')->group(function () {
        Route::get('/list',    [TaskController::class, 'list'])->name('list');
        Route::get('/details', [TaskController::class, 'details'])->name('details');
        Route::get('/create',  [TaskController::class, 'create'])->name('create');
    });

    // ─── Invoice ─────────────────────────────────────────────────────────────
    Route::prefix('invoice')->name('invoice.')->group(function () {
        Route::get('/list',    [InvoiceController::class, 'list'])->name('list');
        Route::get('/details', [InvoiceController::class, 'details'])->name('details');
        Route::get('/create',  [InvoiceController::class, 'create'])->name('create');
    });

    // ─── CRM ─────────────────────────────────────────────────────────────────
    Route::prefix('crm')->name('crm.')->group(function () {
        Route::get('/contacts',      [CrmController::class, 'contacts'])->name('contacts');
        Route::get('/opportunities', [CrmController::class, 'opportunities'])->name('opportunities');
        Route::get('/deals',         [CrmController::class, 'deals'])->name('deals');
        Route::get('/leads',         [CrmController::class, 'leads'])->name('leads');
        Route::get('/pipeline',      [CrmController::class, 'pipeline'])->name('pipeline');
        Route::get('/campaign',      [CrmController::class, 'campaign'])->name('campaign');
        Route::get('/proposals',     [CrmController::class, 'proposals'])->name('proposals');
        Route::get('/estimations',   [CrmController::class, 'estimations'])->name('estimations');
        Route::get('/customers',     [CrmController::class, 'customers'])->name('customers');
        Route::get('/activities',    [CrmController::class, 'activities'])->name('activities');
    });

    // ─── Users ───────────────────────────────────────────────────────────────
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/contacts',         [UserController::class, 'contacts'])->name('contacts');
        Route::get('/profile',          [UserController::class, 'profile'])->name('profile');
        Route::get('/account-settings', [UserController::class, 'accountSettings'])->name('account-settings');
        Route::get('/roles',            [UserController::class, 'roles'])->name('roles');
        Route::get('/role-details',     [UserController::class, 'roleDetails'])->name('role-details');
        Route::get('/permissions',      [UserController::class, 'permissions'])->name('permissions');
    });

    // ─── Finance ─────────────────────────────────────────────────────────────
    Route::prefix('finance')->name('finance.')->group(function () {
        Route::get('/expenses',         [FinanceController::class, 'expenses'])->name('expenses');
        Route::get('/expense-category', [FinanceController::class, 'expenseCategory'])->name('expense-category');
        Route::get('/income',           [FinanceController::class, 'income'])->name('income');
        Route::get('/transactions',     [FinanceController::class, 'transactions'])->name('transactions');
        Route::get('/banks-cards',      [FinanceController::class, 'banksCards'])->name('banks-cards');
    });

    // ─── HRM ─────────────────────────────────────────────────────────────────
    Route::prefix('hrm')->name('hrm.')->group(function () {
        Route::get('/staffs',             [HrmController::class, 'staffs'])->name('staffs');
        Route::get('/staff-profile',      [HrmController::class, 'staffProfile'])->name('staff-profile');
        Route::get('/staff-add',          [HrmController::class, 'staffAdd'])->name('staff-add');
        Route::get('/departments',        [HrmController::class, 'departments'])->name('departments');
        Route::get('/attendance',         [HrmController::class, 'attendance'])->name('attendance');
        Route::get('/leaves',             [HrmController::class, 'leaves'])->name('leaves');
        Route::get('/leave-add',          [HrmController::class, 'leaveAdd'])->name('leave-add');
        Route::get('/holidays',           [HrmController::class, 'holidays'])->name('holidays');
        Route::get('/payroll',            [HrmController::class, 'payroll'])->name('payroll');
        Route::get('/create-salary-slip', [HrmController::class, 'createSalarySlip'])->name('create-salary-slip');
    });

    // ─── Mail ────────────────────────────────────────────────────────────────
    Route::prefix('mail')->name('mail.')->group(function () {
        Route::get('/inbox',   [MailController::class, 'inbox'])->name('inbox');
        Route::get('/details', [MailController::class, 'details'])->name('details');
        Route::get('/compose', [MailController::class, 'compose'])->name('compose');
        Route::get('/outlook', [MailController::class, 'outlook'])->name('outlook');
    });

    // ─── Support Center ──────────────────────────────────────────────────────
    Route::prefix('support')->name('support.')->group(function () {
        Route::get('/ticket-list',    [SupportController::class, 'ticketList'])->name('ticket-list');
        Route::get('/ticket-details', [SupportController::class, 'ticketDetails'])->name('ticket-details');
        Route::get('/ticket-create',  [SupportController::class, 'ticketCreate'])->name('ticket-create');
    });

    // ─── Promo ───────────────────────────────────────────────────────────────
    Route::prefix('promo')->name('promo.')->group(function () {
        Route::get('/coupons',    [PromoController::class, 'coupons'])->name('coupons');
        Route::get('/gift-cards', [PromoController::class, 'giftCards'])->name('gift-cards');
        Route::get('/discounts',  [PromoController::class, 'discounts'])->name('discounts');
    });

    // ─── Apps (Chat, calendar, misc) ─────────────────────────────────────────
    Route::prefix('apps')->name('apps.')->group(function () {
        Route::get('/chat',          [AppsController::class, 'chat'])->name('chat');
        Route::get('/social-feed',   [AppsController::class, 'socialFeed'])->name('social-feed');
        Route::get('/pro-ai',        [AppsController::class, 'proAI'])->name('pro-ai');
        Route::get('/file-manager',  [AppsController::class, 'fileManager'])->name('file-manager');
        Route::get('/calendar',      [AppsController::class, 'calendar'])->name('calendar');
        Route::get('/companies',     [AppsController::class, 'companies'])->name('companies');
        Route::get('/todo',          [AppsController::class, 'todo'])->name('todo');
        Route::get('/pin-board',     [AppsController::class, 'pinBoard'])->name('pin-board');
        Route::get('/clients',       [AppsController::class, 'clients'])->name('clients');
        Route::get('/vote-list',     [AppsController::class, 'voteList'])->name('vote-list');
        Route::get('/issue-tracker', [AppsController::class, 'issueTracker'])->name('issue-tracker');
        Route::get('/api-keys',      [AppsController::class, 'apiKeys'])->name('api-keys');
        Route::get('/manage',        [AppsController::class, 'manage'])->name('manage');
    });

    // ─── Blog ────────────────────────────────────────────────────────────────
    Route::prefix('blog')->name('blog.')->group(function () {
        Route::get('/list',    [BlogController::class, 'list'])->name('list');
        Route::get('/grid',    [BlogController::class, 'grid'])->name('grid');
        Route::get('/article', [BlogController::class, 'article'])->name('article');
        Route::get('/add',     [BlogController::class, 'add'])->name('add');
    });

    // ─── Forum ───────────────────────────────────────────────────────────────
    Route::prefix('forum')->name('forum.')->group(function () {
        Route::get('/view', [ForumController::class, 'view'])->name('view');
        Route::get('/post', [ForumController::class, 'post'])->name('post');
    });

    // ─── Pages ───────────────────────────────────────────────────────────────
    Route::prefix('pages')->name('pages.')->group(function () {
        Route::get('/about-us',           [PageController::class, 'aboutUs'])->name('about-us');
        Route::get('/contact-us',         [PageController::class, 'contactUs'])->name('contact-us');
        Route::get('/pricing',            [PageController::class, 'pricing'])->name('pricing');
        Route::get('/empty',              [PageController::class, 'empty'])->name('empty');
        Route::get('/timeline',           [PageController::class, 'timeline'])->name('timeline');
        Route::get('/gallery',            [PageController::class, 'gallery'])->name('gallery');
        Route::get('/faq',                [PageController::class, 'faq'])->name('faq');
        Route::get('/sitemap',            [PageController::class, 'sitemap'])->name('sitemap');
        Route::get('/search-results',     [PageController::class, 'searchResults'])->name('search-results');
        Route::get('/coming-soon',        [PageController::class, 'comingSoon'])->name('coming-soon');
        Route::get('/privacy-policy',     [PageController::class, 'privacyPolicy'])->name('privacy-policy');
        Route::get('/terms-conditions',   [PageController::class, 'termsConditions'])->name('terms-conditions');
        Route::get('/users-profile',      [PageController::class, 'usersProfile'])->name('users-profile');
    });

    // ─── Layout Options ──────────────────────────────────────────────────────
    Route::prefix('layouts')->name('layouts.')->group(function () {
        Route::get('/boxed',                [LayoutController::class, 'boxed'])->name('boxed');
        Route::get('/compact',              [LayoutController::class, 'compact'])->name('compact');
        Route::get('/horizontal',           [LayoutController::class, 'horizontal'])->name('horizontal');
        Route::get('/preloader',            [LayoutController::class, 'preloader'])->name('preloader');
        Route::get('/scrollable',           [LayoutController::class, 'scrollable'])->name('scrollable');
        Route::get('/sidebar-compact',      [LayoutController::class, 'sidebarCompact'])->name('sidebar-compact');
        Route::get('/sidebar-gradient',     [LayoutController::class, 'sidebarGradient'])->name('sidebar-gradient');
        Route::get('/sidebar-gray',         [LayoutController::class, 'sidebarGray'])->name('sidebar-gray');
        Route::get('/sidebar-image',        [LayoutController::class, 'sidebarImage'])->name('sidebar-image');
        Route::get('/sidebar-light',        [LayoutController::class, 'sidebarLight'])->name('sidebar-light');
        Route::get('/sidebar-no-icons',     [LayoutController::class, 'sidebarNoIcons'])->name('sidebar-no-icons');
        Route::get('/sidebar-offcanvas',    [LayoutController::class, 'sidebarOffcanvas'])->name('sidebar-offcanvas');
        Route::get('/sidebar-on-hover',     [LayoutController::class, 'sidebarOnHover'])->name('sidebar-on-hover');
        Route::get('/sidebar-with-lines',   [LayoutController::class, 'sidebarWithLines'])->name('sidebar-with-lines');
        Route::get('/topbar-dark',          [LayoutController::class, 'topbarDark'])->name('topbar-dark');
        Route::get('/topbar-gradient',      [LayoutController::class, 'topbarGradient'])->name('topbar-gradient');
        Route::get('/topbar-gray',          [LayoutController::class, 'topbarGray'])->name('topbar-gray');
    });

    // ─── Charts ──────────────────────────────────────────────────────────────
    Route::prefix('charts')->name('charts.')->group(function () {
        // Apex
        Route::get('/apex/area',        [ChartController::class, 'apexArea'])->name('apex-area');
        Route::get('/apex/bar',         [ChartController::class, 'apexBar'])->name('apex-bar');
        Route::get('/apex/boxplot',     [ChartController::class, 'apexBoxplot'])->name('apex-boxplot');
        Route::get('/apex/bubble',      [ChartController::class, 'apexBubble'])->name('apex-bubble');
        Route::get('/apex/candlestick', [ChartController::class, 'apexCandlestick'])->name('apex-candlestick');
        Route::get('/apex/column',      [ChartController::class, 'apexColumn'])->name('apex-column');
        Route::get('/apex/funnel',      [ChartController::class, 'apexFunnel'])->name('apex-funnel');
        Route::get('/apex/heatmap',     [ChartController::class, 'apexHeatmap'])->name('apex-heatmap');
        Route::get('/apex/line',        [ChartController::class, 'apexLine'])->name('apex-line');
        Route::get('/apex/mixed',       [ChartController::class, 'apexMixed'])->name('apex-mixed');
        Route::get('/apex/pie',         [ChartController::class, 'apexPie'])->name('apex-pie');
        Route::get('/apex/polar-area',  [ChartController::class, 'apexPolarArea'])->name('apex-polar-area');
        Route::get('/apex/radar',       [ChartController::class, 'apexRadar'])->name('apex-radar');
        Route::get('/apex/radialbar',   [ChartController::class, 'apexRadialbar'])->name('apex-radialbar');
        Route::get('/apex/range',       [ChartController::class, 'apexRange'])->name('apex-range');
        Route::get('/apex/scatter',     [ChartController::class, 'apexScatter'])->name('apex-scatter');
        Route::get('/apex/slope',       [ChartController::class, 'apexSlope'])->name('apex-slope');
        Route::get('/apex/sparklines',  [ChartController::class, 'apexSparklines'])->name('apex-sparklines');
        Route::get('/apex/timeline',    [ChartController::class, 'apexTimeline'])->name('apex-timeline');
        Route::get('/apex/treemap',     [ChartController::class, 'apexTreemap'])->name('apex-treemap');
        // ChartJS
        Route::get('/chartjs/area',  [ChartController::class, 'chartjsArea'])->name('chartjs-area');
        Route::get('/chartjs/bar',   [ChartController::class, 'chartjsBar'])->name('chartjs-bar');
        Route::get('/chartjs/line',  [ChartController::class, 'chartjsLine'])->name('chartjs-line');
        Route::get('/chartjs/other', [ChartController::class, 'chartjsOther'])->name('chartjs-other');
        // EChart
        Route::get('/echart/area',        [ChartController::class, 'echartArea'])->name('echart-area');
        Route::get('/echart/bar',         [ChartController::class, 'echartBar'])->name('echart-bar');
        Route::get('/echart/candlestick', [ChartController::class, 'echartCandlestick'])->name('echart-candlestick');
        Route::get('/echart/gauge',       [ChartController::class, 'echartGauge'])->name('echart-gauge');
        Route::get('/echart/geo-map',     [ChartController::class, 'echartGeoMap'])->name('echart-geo-map');
        Route::get('/echart/heatmap',     [ChartController::class, 'echartHeatmap'])->name('echart-heatmap');
        Route::get('/echart/line',        [ChartController::class, 'echartLine'])->name('echart-line');
        Route::get('/echart/other',       [ChartController::class, 'echartOther'])->name('echart-other');
        Route::get('/echart/pie',         [ChartController::class, 'echartPie'])->name('echart-pie');
        Route::get('/echart/radar',       [ChartController::class, 'echartRadar'])->name('echart-radar');
        Route::get('/echart/scatter',     [ChartController::class, 'echartScatter'])->name('echart-scatter');
    });

    // ─── Widgets ─────────────────────────────────────────────────────────────
    Route::prefix('widgets')->name('widgets.')->group(function () {
        Route::get('/charts',     [WidgetController::class, 'charts'])->name('charts');
        Route::get('/mixed',      [WidgetController::class, 'mixed'])->name('mixed');
        Route::get('/social',     [WidgetController::class, 'social'])->name('social');
        Route::get('/statistics', [WidgetController::class, 'statistics'])->name('statistics');
        Route::get('/weather',    [WidgetController::class, 'weather'])->name('weather');
    });

    // ─── Forms ───────────────────────────────────────────────────────────────
    Route::prefix('forms')->name('forms.')->group(function () {
        Route::get('/elements',      [FormController::class, 'elements'])->name('elements');
        Route::get('/layout',        [FormController::class, 'layout'])->name('layout');
        Route::get('/select',        [FormController::class, 'select'])->name('select');
        Route::get('/fileuploads',   [FormController::class, 'fileuploads'])->name('fileuploads');
        Route::get('/wizard',        [FormController::class, 'wizard'])->name('wizard');
        Route::get('/validation',    [FormController::class, 'validation'])->name('validation');
        Route::get('/pickers',       [FormController::class, 'pickers'])->name('pickers');
        Route::get('/range-slider',  [FormController::class, 'rangeSlider'])->name('range-slider');
        Route::get('/text-editors',  [FormController::class, 'textEditors'])->name('text-editors');
        Route::get('/other-plugin',  [FormController::class, 'otherPlugin'])->name('other-plugin');
        Route::get('/cropper',       [FormController::class, 'cropper'])->name('cropper');
    });

    // ─── Tables ──────────────────────────────────────────────────────────────
    Route::prefix('tables')->name('tables.')->group(function () {
        Route::get('/static',                    [TableController::class, 'static'])->name('static');
        Route::get('/custom',                    [TableController::class, 'custom'])->name('custom');
        Route::get('/datatables/basic',          [TableController::class, 'datatablesBasic'])->name('datatables-basic');
        Route::get('/datatables/ajax',           [TableController::class, 'datatablesAjax'])->name('datatables-ajax');
        Route::get('/datatables/checkbox',       [TableController::class, 'datatablesCheckbox'])->name('datatables-checkbox');
        Route::get('/datatables/child-rows',     [TableController::class, 'datatablesChildRows'])->name('datatables-child-rows');
        Route::get('/datatables/col-searching',  [TableController::class, 'datatablesColSearch'])->name('datatables-col-searching');
        Route::get('/datatables/columns',        [TableController::class, 'datatablesColumns'])->name('datatables-columns');
        Route::get('/datatables/export',         [TableController::class, 'datatablesExport'])->name('datatables-export');
        Route::get('/datatables/fixed-columns',  [TableController::class, 'datatablesFixedCols'])->name('datatables-fixed-cols');
        Route::get('/datatables/fixed-header',   [TableController::class, 'datatablesFixedHeader'])->name('datatables-fixed-header');
        Route::get('/datatables/js',             [TableController::class, 'datatablesJS'])->name('datatables-js');
        Route::get('/datatables/range',          [TableController::class, 'datatablesRange'])->name('datatables-range');
        Route::get('/datatables/rendering',      [TableController::class, 'datatablesRendering'])->name('datatables-rendering');
        Route::get('/datatables/rows-add',       [TableController::class, 'datatablesRowsAdd'])->name('datatables-rows-add');
        Route::get('/datatables/scroll',         [TableController::class, 'datatablesScroll'])->name('datatables-scroll');
        Route::get('/datatables/select',         [TableController::class, 'datatablesSelect'])->name('datatables-select');
    });

    // ─── Icons ───────────────────────────────────────────────────────────────
    Route::prefix('icons')->name('icons.')->group(function () {
        Route::get('/lucide',       [IconController::class, 'lucide'])->name('lucide');
        Route::get('/remix',        [IconController::class, 'remix'])->name('remix');
        Route::get('/solar-duotone',[IconController::class, 'solarDuotone'])->name('solar-duotone');
        Route::get('/tabler',       [IconController::class, 'tabler'])->name('tabler');
        Route::get('/flags',        [IconController::class, 'flags'])->name('flags');
    });

    // ─── Maps ────────────────────────────────────────────────────────────────
    Route::prefix('maps')->name('maps.')->group(function () {
        Route::get('/google',  [MapController::class, 'google'])->name('google');
        Route::get('/leaflet', [MapController::class, 'leaflet'])->name('leaflet');
        Route::get('/vector',  [MapController::class, 'vector'])->name('vector');
    });

    // ─── Plugins ─────────────────────────────────────────────────────────────
    Route::prefix('plugins')->name('plugins.')->group(function () {
        Route::get('/sortable',      [PluginController::class, 'sortable'])->name('sortable');
        Route::get('/pdf-viewer',    [PluginController::class, 'pdfViewer'])->name('pdf-viewer');
        Route::get('/i18',           [PluginController::class, 'i18'])->name('i18');
        Route::get('/sweet-alerts',  [PluginController::class, 'sweetAlerts'])->name('sweet-alerts');
        Route::get('/idle-timer',    [PluginController::class, 'idleTimer'])->name('idle-timer');
        Route::get('/pass-meter',    [PluginController::class, 'passMeter'])->name('pass-meter');
        Route::get('/masonry',       [PluginController::class, 'masonry'])->name('masonry');
        Route::get('/animation',     [PluginController::class, 'animation'])->name('animation');
        Route::get('/tour',          [PluginController::class, 'tour'])->name('tour');
        Route::get('/tree-view',     [PluginController::class, 'treeView'])->name('tree-view');
        Route::get('/clipboard',     [PluginController::class, 'clipboard'])->name('clipboard');
        Route::get('/video-player',  [PluginController::class, 'videoPlayer'])->name('video-player');
    });

    // ─── Base UI ─────────────────────────────────────────────────────────────
    Route::prefix('ui')->name('ui.')->group(function () {
        Route::get('/accordions',   [UiController::class, 'accordions'])->name('accordions');
        Route::get('/alerts',       [UiController::class, 'alerts'])->name('alerts');
        Route::get('/badges',       [UiController::class, 'badges'])->name('badges');
        Route::get('/breadcrumb',   [UiController::class, 'breadcrumb'])->name('breadcrumb');
        Route::get('/buttons',      [UiController::class, 'buttons'])->name('buttons');
        Route::get('/cards',        [UiController::class, 'cards'])->name('cards');
        Route::get('/carousel',     [UiController::class, 'carousel'])->name('carousel');
        Route::get('/collapse',     [UiController::class, 'collapse'])->name('collapse');
        Route::get('/colors',       [UiController::class, 'colors'])->name('colors');
        Route::get('/dropdowns',    [UiController::class, 'dropdowns'])->name('dropdowns');
        Route::get('/grid',         [UiController::class, 'grid'])->name('grid');
        Route::get('/images',       [UiController::class, 'images'])->name('images');
        Route::get('/links',        [UiController::class, 'links'])->name('links');
        Route::get('/list-group',   [UiController::class, 'listGroup'])->name('list-group');
        Route::get('/modals',       [UiController::class, 'modals'])->name('modals');
        Route::get('/notifications',[UiController::class, 'notifications'])->name('notifications');
        Route::get('/offcanvas',    [UiController::class, 'offcanvas'])->name('offcanvas');
        Route::get('/pagination',   [UiController::class, 'pagination'])->name('pagination');
        Route::get('/placeholders', [UiController::class, 'placeholders'])->name('placeholders');
        Route::get('/popovers',     [UiController::class, 'popovers'])->name('popovers');
        Route::get('/progress',     [UiController::class, 'progress'])->name('progress');
        Route::get('/scrollspy',    [UiController::class, 'scrollspy'])->name('scrollspy');
        Route::get('/spinners',     [UiController::class, 'spinners'])->name('spinners');
        Route::get('/tabs',         [UiController::class, 'tabs'])->name('tabs');
        Route::get('/tooltips',     [UiController::class, 'tooltips'])->name('tooltips');
        Route::get('/typography',   [UiController::class, 'typography'])->name('typography');
        Route::get('/utilities',    [UiController::class, 'utilities'])->name('utilities');
        Route::get('/videos',       [UiController::class, 'videos'])->name('videos');
    });

    // ─── Errors ──────────────────────────────────────────────────────────────
    Route::prefix('errors')->name('errors.')->group(function () {
        Route::get('/400',         [ErrorController::class, 'e400'])->name('400');
        Route::get('/401',         [ErrorController::class, 'e401'])->name('401');
        Route::get('/403',         [ErrorController::class, 'e403'])->name('403');
        Route::get('/404',         [ErrorController::class, 'e404'])->name('404');
        Route::get('/408',         [ErrorController::class, 'e408'])->name('408');
        Route::get('/429',         [ErrorController::class, 'e429'])->name('429');
        Route::get('/500',         [ErrorController::class, 'e500'])->name('500');
        Route::get('/502',         [ErrorController::class, 'e502'])->name('502');
        Route::get('/503',         [ErrorController::class, 'e503'])->name('503');
        Route::get('/504',         [ErrorController::class, 'e504'])->name('504');
        Route::get('/maintenance', [ErrorController::class, 'maintenance'])->name('maintenance');
    });

});
