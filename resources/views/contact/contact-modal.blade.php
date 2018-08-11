<div class="modal" id="contact-modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      </div>
      <div class="modal-body">
        <form role="form" id="contact-form">
          <div class="form-group">
            <h5>Reason for contact (select all that apply).</h5>
            <select multiple class="form-control" name="topics[]" id="contact-topics" size="5">

            </select>
          </div>
          <div class="form-group">
            <h5>Provide a brief summary of what you are looking for.</h5>
            <textarea class="form-control input-global" rows="2" id="advisor-contact-input" name="advisor-contact-input"></textarea>
          </div>
          <span class="help-block">To keep your personal information confidential, we will only share your first name with the advisor.</span>
        </form>
        <div id="contact-confirm-view">
          <div class="alert alert-success" role="alert">Message successfully sent!</div>
          <h5>We will notify you once the advisor responds to your contact request.</h5>
          <h5>Access this discussion page <a href="" id="contact-confirm-link">here</a> or by going to the Discussions tab in your profile.</h5>
        </div>
      </div>
      <div class="modal-footer">
        <div id="footer-submit">
          <button type="button" class="btn btn-global" id="contact-submit">Submit</button>
          <button type="button" class="btn btn-secondary" id="contact-cancel" data-dismiss="modal">Cancel</button>
        </div>
        <div id="footer-confirm">
          <button type="button" class="btn btn-secondary" id="contact-cancel" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>