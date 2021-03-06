<div class="wrapper wrapper-content animated fadeIn" style="display: none">
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Toastr examples</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="#">Config option 1</a>
                                </li>
                                <li><a href="#">Config option 2</a>
                                </li>
                            </ul>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                        <label for="title">Title</label>
                                        <input id="title" type="text" class="form-control" placeholder="Enter a title ..."/>
                                    </div>
                                <div class="form-group">
                                        <label for="message">Message</label>
                                        <textarea class="form-control" id="message" rows="3" placeholder="Enter a message ..."></textarea>
                                </div>
                                    <div class="checkbox">
                                        <label class="checkbox" for="closeButton">
                                            <input id="closeButton" type="checkbox" value="checked" class="input-mini" checked/>Close Button
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label class="checkbox" for="addBehaviorOnToastClick">
                                            <input id="addBehaviorOnToastClick" type="checkbox" value="checked" class="input-mini" />Add behavior on toast click
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label class="checkbox" for="debugInfo">
                                            <input id="debugInfo" type="checkbox" value="checked" class="input-mini" />Debug
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label class="checkbox" for="progressBar">
                                            <input id="progressBar" type="checkbox" value="checked" class="input-mini" checked/>Progress Bar
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label class="checkbox" for="preventDuplicates">
                                            <input id="preventDuplicates" type="checkbox" value="checked" class="input-mini" />Prevent Duplicates
                                        </label>
                                    </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group" id="toastTypeGroup">
                                        <label>Toast Type</label>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="toasts" value="success" checked />Success
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label class="radio">
                                            <input type="radio" name="toasts" value="info" />Info
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label class="radio">
                                            <input type="radio" name="toasts" value="warning" />Warning
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label class="radio">
                                            <input type="radio" name="toasts" value="error" />Error
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group" id="positionGroup">
                                        <label>Position</label>
                                    <div class="radio">
                                        <label >
                                            <input type="radio" name="positions" value="toast-top-right"  />Top Right
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label >
                                            <input type="radio" name="positions" value="toast-bottom-right" />Bottom Right
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label >
                                            <input type="radio" name="positions" value="toast-bottom-left" />Bottom Left
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label >
                                            <input type="radio" name="positions" value="toast-top-left" />Top Left
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label >
                                            <input type="radio" name="positions" value="toast-top-full-width" />Top Full Width
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label >
                                            <input type="radio" name="positions" value="toast-bottom-full-width" />Bottom Full Width
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label >
                                            <input type="radio" name="positions" value="toast-top-center" />Top Center
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label >
                                            <input type="radio" name="positions" value="toast-bottom-center" />Bottom Center
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label >
                                            <input type="radio" name="positions" value="toast-middle-center" checked />Middle Center
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="showEasing">Show Easing</label>
                                    <input id="showEasing" type="text" placeholder="swing, linear" class="form-control" value="swing"/>
                                </div>
                                <div class="form-group">

                                    <label for="hideEasing">Hide Easing</label>
                                    <input id="hideEasing" type="text" placeholder="swing, linear" class="form-control" value="linear"/>
                                </div>
                                <div class="form-group">

                                    <label for="showMethod">Show Method</label>
                                    <input id="showMethod" type="text" placeholder="show, fadeIn, slideDown" class="form-control" value="fadeIn"/>
                                </div>
                                <div class="form-group">

                                    <label for="hideMethod">Hide Method</label>
                                    <input id="hideMethod" type="text" placeholder="hide, fadeOut, slideUp" class="form-control" value="fadeOut"/>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                        <label for="showDuration">Show Duration</label>
                                        <input id="showDuration" type="text" placeholder="ms" class="form-control" value="400" />
                                </div>
                                <div class="form-group">
                                        <label for="hideDuration">Hide Duration</label>
                                        <input id="hideDuration" type="text" placeholder="ms" class="form-control" value="1000" />
                                </div>
                                <div class="form-group">
                                        <label for="timeOut">Time out</label>
                                        <input id="timeOut" type="text" placeholder="ms" class="form-control" value="7000" />
                                </div>
                                <div class="form-group">
                                        <label for="extendedTimeOut">Extended time out</label>
                                        <input id="extendedTimeOut" type="text" placeholder="ms" class="form-control" value="1000" />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                            <button type="button" class="btn btn-primary" id="showtoast">Show Toast</button>
                            <button type="button" class="btn btn-white" id="cleartoasts">Clear Toasts</button>
                            <button type="button" class="btn btn-white" id="clearlasttoast">Clear Last Toast</button>
                            <button type="button" class="btn btn-white" id="showsimple">Show simple options</button>
                            </div>
                        </div>

                        <div class="row m-t-lg">
                            <div class="col-lg-12">
                            <small>Toastr Options in JSON</small>
                            <pre id="toastrOptions" class="p-m"></pre>
                        </div>
                        </div>

                    </div>
                </div>
            </div>
            </div>
        </div>
        

            <script type="text/javascript">
                window.onload = function() {  

                   // success_msg();
                   toastr.options = {
                      "closeButton": true,
                      "debug": false,
                      "progressBar": true,
                      "preventDuplicates": false,
                      "positionClass": "toast-top-center",
                      "onclick": null,
                      "showDuration": "400",
                      "hideDuration": "1000",
                      "timeOut": "7000",
                      "extendedTimeOut": "1000",
                      "showEasing": "swing",
                      "hideEasing": "linear",
                      "showMethod": "fadeIn",
                      "hideMethod": "fadeOut"
                    }
                    toastr.success('<?php echo $this->session->flashdata('success')?>');
                }
                //$(function () {
                    var i = -1;
                    var toastCount = 0;
                    var $toastlast;
                    var getMessage = function () {
                        var msg = '<?php echo $this->session->flashdata('success')?>';                        
                        return msg;
                    };

                    
            
            </script>