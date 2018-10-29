<div class="message success" style="display: {{Session::get('successMessage') ? 'block' : 'none'}}">
   <div class="message-wrap">
       <p>{{Session::get('successMessage')}}</p>
       <span class="close-popup"><img src="/img/error.svg" width="15"/> </span>
   </div>
</div>
<div class="message error" style="display: {{Session::get('errorMessage') ? 'block' : 'none'}}">
   <div class="message-wrap">
       <p>{{Session::get('errorMessage')}}</p>
       <span class="close-popup"><img src="/img/error.svg" width="15"/> </span>
   </div>
</div>
<div class="message info" style="display: {{Session::get('infoMessage') ? 'block' : 'none'}}">
  <div class="message-wrap">
      <p>{{Session::get('infoMessage')}}</p>
      <span class="close-popup"><img src="/img/error.svg" width="15"/> </span>
  </div>
</div>