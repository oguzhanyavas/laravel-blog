</div>
</div>

<hr>

<!-- Footer -->

<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <ul class="list-inline text-center">
                    @if ($configs->twitter)
                    <li class="list-inline-item">
                        <a href="{{ $configs->twitter }}">
                            <span class="fa-stack fa-lg">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fab fa-twitter fa-stack-1x fa-inverse"></i>
                            </span>
                        </a>
                    </li>
                    @endif
                    @if ($configs->facebook)
                    <li class="list-inline-item">
                        <a href="{{ $configs->facebook }}">
                            <span class="fa-stack fa-lg">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fab fa-facebook-f fa-stack-1x fa-inverse"></i>
                            </span>
                        </a>
                    </li>
                    @endif
                    @if ($configs->instagram)
                    <li class="list-inline-item">
                        <a href="{{ $configs->instagram }}">
                            <span class="fa-stack fa-lg">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fab fa-instagram fa-stack-1x fa-inverse"></i>
                            </span>
                        </a>
                    </li>
                    @endif
                    @if ($configs->youtube)
                    <li class="list-inline-item">
                        <a href="{{ $configs->youtube }}">
                            <span class="fa-stack fa-lg">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fab fa-youtube fa-stack-1x fa-inverse"></i>
                            </span>
                        </a>
                    </li>
                    @endif
                    @if ($configs->github)
                    <li class="list-inline-item">
                        <a href="{{ $configs->github }}">
                            <span class="fa-stack fa-lg">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fab fa-github fa-stack-1x fa-inverse"></i>
                            </span>
                        </a>
                    </li>
                    @endif
                    @if ($configs->linkedin)
                    <li class="list-inline-item">
                        <a href="{{ $configs->linkedin }}">
                            <span class="fa-stack fa-lg">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fab fa-linkedin fa-stack-1x fa-inverse"></i>
                            </span>
                        </a>
                    </li>
                    @endif
                </ul>
                <p class="copyright text-muted">Copyright &copy; {{ $configs->title }} {{ date('Y') }}</p>
            </div>
        </div>
    </div>
</footer>

<!-- Bootstrap core JavaScript -->
<script src="{{asset('front')}}/vendor/jquery/jquery.min.js"></script>
<script src="{{asset('front')}}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Custom scripts for this template -->
<script src="{{asset('front')}}/js/clean-blog.min.js"></script>

</body>

</html>