 <style>
     body#full-dark .ai .caption .caption-toolbar {
         border-left: 1px solid #323a5f;
         border-right: 1px solid #323a5f;
         border-bottom: 1px solid #323a5f;
         border-top: 1px solid #323a5f;
         background-color: #192038;
     }

     body#full-dark .ai .caption .caption-toolbar .item {
         color: #fff;
         border-right: 1px solid #323a5f;
     }


     .caption-toolbar a.item {
         height: 30px;
         line-height: 30px;
         padding: 0 10px;
         display: inline-block;
         border-right: 1px solid #f1f1f1;
         float: left;
     }

     .ai .caption .caption-toolbar {
         border-left: 1px solid #f4f4f4;
         border-right: 1px solid #f4f4f4;
         border-bottom: 1px solid #f4f4f4;
         background: #fbfbfb;
         border-radius: 0 0 4px 4px;
         height: 30px;
     }

     .ai .caption .caption-toolbar .item {
         height: 30px;
         line-height: 30px;
         padding: 0 10px;
         display: inline-block;
         border-right: 1px solid #f1f1f1;
         float: left;
     }

     #overlay {
         position: static;
         top: 0;
         z-index: 100;
         width: 100%;
         display: none;
         margin-top: 20px;
         background: rgba(0, 0, 0, 0.6);
     }

     .cv-spinner {
         height: 100%;
         display: flex;
         justify-content: center;
         align-items: center;
     }

     .spinner {
         width: 40px;
         height: 40px;
         border: 4px #ddd solid;
         border-top: 4px #2e93e6 solid;
         border-radius: 50%;
         animation: sp-anime 0.8s infinite linear;
     }

     @keyframes sp-anime {
         100% {
             transform: rotate(360deg);
         }
     }

     .is-hide {
         display: none;
     }
 </style>
 <div class="ai">
     <div class="fm-action text-center">

     </div>
     <div style="padding-bottom: 20px;"></div>
     <div></div>
     <div style="padding: 10px;" class="title fs-16"><i class="far fa-hand-spock"></i> Let Our A.I. Get You Some Post Ideas</div>
     <h3></h3>
     <form id="ideaform" method="post" style="-webkit-box-shadow: 5px 5px 15px 5px rgba(0,0,0,0.19); 
box-shadow: 5px 5px 15px 5px rgba(0,0,0,0.19);">
         <div class="input-group">
             <input class="form-control" type="text" id="topic" name="topic" placeholder="<?php _e("Enter a topic") ?>">
             <button class="btn " id="generate" style="color: #113098 " type="submit"><i class="fas fa-search"></i></button>
         </div>
         <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

     </form>
     <div id="overlay">
         <div class="cv-spinner">
             <span class="spinner"></span>
         </div>
     </div>
     <div id="captionidea" style="display: none;" class="caption m-t-15">
         <textarea id="ideagenerator" disabled="true" style="height: 400px; padding: 10px; width: 100%;"></textarea>
         <div class="caption-toolbar">
             <div class="item">
                 <div class="count-word"><i class="fas fa-text-width"></i> <span>0</span></div>
             </div>
         </div>
     </div>
 </div>


 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

 <script type="text/javascript">
     $("#generate").click(function(e) {
         e.preventDefault();
         var topic = $("#topic").val();
         $("#overlay").fadeIn(300);
         $.ajax({
             url: "<?php echo site_url('post/topic'); ?>",
             method: "POST",
             data: {
                 topic: topic
             },
             success: function(data) {
                 $("#overlay").fadeOut(300);

                 $("#ideagenerator").val(data);
                 $("#captionidea").css("display", "block");

                 $("#ideagenerator").css("display", "block");



             },
             error: function() {
                 $("#overlay").fadeOut(300);

                 alert("Something went wrong. Please try again later.");
             }
         });
     });
 </script>