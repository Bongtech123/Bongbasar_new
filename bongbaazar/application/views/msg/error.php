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
        toastr.error('<?php echo $this->session->flashdata('error')?>');
    }
    //$(function () {
        var i = -1;
        var toastCount = 0;
        var $toastlast;
        var getMessage = function () {
            var msg = '<?php echo $this->session->flashdata('error')?>';                        
            return msg;
        };

        

</script>

            