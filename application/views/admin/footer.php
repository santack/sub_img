                        </div>
                        </div>
                        </main>
                        </div>
                        <footer class="c-footer">
                            <div><a href="#">DEMO</a> &copy; 2022 Creative Labs</div>

                            <!-- <div class="ml-auto">Powered by&nbsp;<a href="#">wynndarrien</a></div> -->
                        </footer>
                        </div>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>



                        <script src="<?= base_url() ?>assets/js/bundle.js"></script>

                        <script src="<?= base_url() ?>assets/js/icons.js"></script>

                        <script src="<?= base_url() ?>assets/js/utils.js"></script>

                        <script src="<?= base_url() ?>assets/js/custom.js"></script>

                        <script src="<?= base_url() ?>assets/js/permission.js"></script>

                        <script src="<?= base_url() ?>assets/plugins/datatable/js/jquery.dataTables.js"></script>
                        <script src="<?= base_url() ?>assets/plugins/datatable/js/dataTables.bootstrap4.min.js"></script>

                        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
                        <!-- import ckeditor css/js -->
                        <script src="https://cdn.ckeditor.com/4.16.1/full/ckeditor.js"></script>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js"></script>
                        </body>

                        </html>

                        <script>
                            $('.datatable').DataTable();
                            $('.datatable').attr('style', 'border-collapse: collapse !important');
                            // $('.select2').select2();

                            $(document).ready(function() {
                                $('.summernote').summernote({
                                    height: 300,
                                    toolbar: [
                                        ['style', ['bold', 'italic', 'underline', 'clear']],
                                        ['font', ['strikethrough', 'superscript', 'subscript']],
                                        ['fontsize', ['fontsize']],
                                        ['color', ['color']],
                                        ['para', ['ul', 'ol', 'paragraph']],
                                        ['height', ['height']]
                                    ]
                                });
                            });
                            $('.note-editable').css('font-size', '1rem');

                            // $(document).ready(function() {
                            //     $('.ckeditor').ckeditor({
                            //         height: 400,
                            //         baseFloatZIndex: 10005
                            //     });
                            // });
                        </script>

                        <script src="<?= base_url() ?>assets/plugins/chartjs/js/chartjs.js"></script>
                        <script>
                            $(document).on("click", ".delete-button", function(e) {
                                e.preventDefault();

                                var delete_record = confirm("Are you sure you want to delete this record?");
                                var id = $(this).data("id");
                                var path = $(this).data("path");

                                if (delete_record === true) {
                                    window.location.replace("<?= base_url() ?>" + path + "/delete/" + id);
                                }
                            });

                            $(document).on("click", ".c-sidebar-nav-dropdown", function(e) {

                                var result = $(this).hasClass('c-show');
                                if (result) {
                                    $(this).removeClass('c-show');
                                } else {
                                    $(this).addClass('c-show');
                                }
                            });
                        </script>