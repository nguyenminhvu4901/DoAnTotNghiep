/**
 * Javascript code that run on all screen of the application
 */
(function (yourcode) {
    yourcode(window.jQuery, window, document);
  }(function ($, window, document) {
    window.onbeforeunload = function () {
      $('button[type="submit"]').each(function() {
        if($(this).hasClass('btn-no-disable')) {
          $(this).prop('disabled', false)
        }
      }) 
    }
    $(function () {
      /**
       * Ajax setup csrf-token
       */
      $.ajaxSetup({
        headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
          Accept: "application/json",
        },
      });
  
      /**
       * Search by tag, needs #input-search-tag as form and #btn-search-tag as button[type=submit]
       */
      $(document).off('click', '.search-tag').on('click', '.search-tag', function () {
        $("#input-search-tag").val($(this).html())
        $("#btn-search-tag").click()
      })
  
      /**
       * when element has data-toggle attribute assigned to "popover",
       * it will be handled by bootstrap, to display a bubble
       * https://getbootstrap.com/docs/4.6/components/popovers/
       */
      $(function () {
        $('[data-toggle="popover"]').popover({
          html: true
        })
      })
  
      // Sidebar collapse (small screen)
      $('#sidebarContainerCollapse').on('click', function () {
        $('#sidebar-container').toggleClass('active');
      });
      $(window).on("resize", function () {
        if($('#sidebar-container').hasClass('default-sidebar')) {
          if ($(window).width() > 900) {
            $('#sidebar-container').removeClass('active');
            $('#content-container').css('width', '80%');
          } else {
            $('#content-container').css('width', '100%');
          }
        }
      });
  
      // Sidebar group item collapse arrow animation
      const divCollapse = $('.sidebar-items-collapse');
      divCollapse.on('show.bs.collapse', function () {
        $(this).prev('.menu-parent').addClass('active');
      });
      divCollapse.on('hide.bs.collapse', function () {
        $(this).prev('.menu-parent').removeClass('active');
      });
  
      // Change type of a-simple-switch rendered button
      $('input[data-type="simple-switch"]').next('button._simple-switch-track').attr('type', 'button');
    });
  }))
  
  /**
   * Global Constants
   */
  constants = (function () {
    let modules = {};
    modules.METHOD_GET = "GET";
    modules.METHOD_POST = "POST";
    modules.METHOD_PUT = "PUT";
    modules.METHOD_DELETE = "DELETE";
    modules.METHOD_PATH = "PATH";
    modules.debug = false;
    modules.weekDays = [
      'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'
    ]
    modules.youtubeOembedUrl = "http://www.youtube.com/oembed?url=http://www.youtube.com/watch?v=";
    modules.youtubeEmbeddedVideoUrl = "https://www.youtube.com/embed/";
    modules.youtubeUrlReg = /(?:((http?(?:s)?:\/\/)?(www\.)?)?(?:youtu\.be\/|youtube(?:-nocookie)?\.com\/(?:embed\/|shorts\/|v\/|watch\?v=|watch\?(?:([^=]+)\=([^&]+))+&v=)))?((?:\w|-){11}|^(?:\w|-){11}$)((?:\&|\?)\S*)?/;
    modules.csrfAjax = {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    };
    modules.iframeSlideShowPrefix = "https://view.officeapps.live.com/op/embed.aspx?src=";
    modules.googleDriveUrlReg = /\/presentation\/d\/([a-zA-Z0-9-_]+)\//;
    modules.googleDriveEmbeded = function (id) {
      return 'https://docs.google.com/presentation/d/' + id +  '/embed?'
    }
    modules.phpConstant = $('#js-global-constants')
    return modules;
  }(window.jQuery, window, document))
  
  actions = (function () {
    let modules = {};
  
    modules.uploadFileAndGetUrl = async (fileData, routeUrl) => {
      let formData = new FormData();
      if(fileData) {
        formData.append('file', fileData);
      }
      try {
        return await actions.ajaxCall({
          url: routeUrl,
          data: formData,
          processData: false,
          contentType: false,
          method: 'POST',
        });
      } catch (error) {
        throw error;
      }
    }
  
    modules.extractGoogleSlidesId = function(url) {
      const pattern = constants.googleDriveUrlReg;
      const matches = url.match(pattern);
      if (matches && matches[1]) {
        return matches[1];
      }
      return null;
    }
  
    modules.ckinit = function (selector = '#ckeditor') {
      if ($(selector).length) {
        return ClassicEditor
          .create(document.querySelector(selector), {
            ckfinder: {
              uploadUrl: constants.phpConstant.data('ckeditor-image-url'),
            }
          })
          .then(function () {
            const ckeditor = $(selector);
            const error = ckeditor.hasClass('is-invalid');
            if (error) {
              ckeditor.next().addClass('custom-error-box');
            }
          })
      }
      return false
    }
  
    modules.ajaxCall = function (options) {
      return $.ajax({
        headers: constants.csrfAjax,
        ...options
      })
    }

    
  
    modules.showLoading = function () {
      $('#loading-spinner').addClass('loading');
    }
  
    modules.hideLoading = function () {
      $('#loading-spinner').removeClass('loading');
    }
  
    return modules;
  }(window.jQuery, window, document))
  