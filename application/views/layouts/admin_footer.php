</div>
            <!-- / #content-wrapper -->
            <div id="main-menu-bg"></div>
        </div>
        <!-- / #main-wrapper -->

        <!-- Pixel Admin's javascripts -->
        <script src="<?php echo base_url() ?>assets/admin/javascripts/bootstrap.min.js"></script>
        <script src="<?php echo base_url() ?>assets/admin/javascripts/pixel-admin.min.js"></script>
        <script type="text/javascript">
            init.push(function () {
                // Javascript code here
            });
            window.PixelAdmin.start(init);
        </script>
        <script type="text/javascript">
            function selectAll(entry_chk, entry_id) {
                //var toggleTo = (document.getElementsByName(entry_chk)[0].checked);
                var toggleTo = entry_chk.checked;
                var entry = document.getElementsByName(entry_id);
                for (i = 0; i < entry.length; i++) {
                    entry[i].checked = toggleTo;
                }
            }
        </script>

    </body>
</html>