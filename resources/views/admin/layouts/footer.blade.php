<!-- Footer Start -->
<footer class="footer">
    <div class="container-fluid">
        @php $appName = config('app.name'); @endphp
        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-start">
                <script>
                    document.write(new Date().getFullYear())
                </script>
                &copy; <span class="fw-semibold">{{ $appName }}</span>
            </div>
            <div class="col-md-6 mt-2 mt-md-0">
                <div class="d-flex justify-content-center justify-content-md-end gap-3">
                    <span class="text-muted">Company: {{ $appName }}</span>
                    <a href="https://www.linkedin.com/in/tahsin-abrar/" target="_blank" rel="noopener noreferrer" class="link-reset">
                        LinkedIn Support
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>
