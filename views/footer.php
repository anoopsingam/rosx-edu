<footer class="footer pt-3  ">
                <div class="container-fluid">
                    <div class="row align-items-center justify-content-lg-between">
                        <div class="col-lg-6 mb-lg-0 mb-4">
                            <div class="copyright text-center text-sm text-muted text-lg-start">
                                © <?= date("Y")?> made with <i class="text-danger fa fa-heart"></i> by
                                <a href="https://www.roborosx.com" class="font-weight-bold text-primary" target="_blank">RoborosX Multi Tech Solutions LLP </a> 
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
</main>


 <?=includes::js();?>

    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>

    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <script src="<?=url::myurl()?>/assets/js/soft-ui-dashboard.min.js?v=1.0.8"></script>
</body>

</html>