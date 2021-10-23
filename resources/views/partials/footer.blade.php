<!-- Footer -->
<footer class="footer pt-0">
    <div class="row mx-0 align-items-center justify-content-lg-between">
        <div class="col-lg-12">
            <div class="copyright text-center">
                &copy; 2020 Loanzspot All Rights Reserved.
            </div>
        </div>
    </div>
</footer>
<form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
</form>
</div>
</div>
