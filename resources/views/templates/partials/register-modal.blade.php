<div class="modal" id="register-modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><span id="register-modal-register-btn">Register</span> or <span id="register-modal-login-btn">Log In</span></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body modal-body-register">
        <form method="post" action="/register" id="register-modal-form">
              <div class="row">
                  <div class="form-group col-sm-6">
                    <input type="text" class="form-control" name="first_name" id="first-name" placeholder="First Name" />
                  </div>
                  <div class="form-group col-sm-6">
                    <input type="text" class="form-control" name="last_name" id="last-name" placeholder="Last Name" />
                  </div>
              </div>
              <div class="form-group">
                  <select class="form-control{{ $errors->has('age_range') ? ' is-invalid' : '' }}" id="age-range" name="age_range">
                      <option selected>Select your age range</option>
                      <option value="13-17">13 - 17 years old</option>
                      <option value="18-24">18 - 24 years old</option>
                      <option value="25-34">25 - 34 years old</option>
                      <option value="35-44">35 - 44 years old</option>
                      <option value="45-54">45 - 54 years old</option>
                      <option value="55-64">55 - 64 years old</option>
                      <option value="65-74">65 - 74 years old</option>
                      <option value="75+">75 years or older</option>
                  </select>
                  @if ($errors->has('age_range'))
                      <div class="invalid-feedback">{{ $errors->first('age_range') }}</div>
                  @endif
              </div>
              <div class="form-group">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Email" />
              </div>
              <div class="form-group">
                  <input type="password" class="form-control" name="password" id="password" placeholder="Password" />
              </div>
              <div class="form-group">
                  <input type="password" class="form-control" name="password_confirmation" id="confirm-password" placeholder="Confirm Password" />
              </div>
              <div class="checkbox">
                  <label>
                      <input type="checkbox"> Remember Me
                  </label>
              </div>
              <button type="submit" class="btn btn-default">Submit</button>
              <input type="hidden" name="_token" value="{{ Session::token() }}"/>
          </form>
          <h6>By registering as a user of Fadvi, you agree to our <a href="{{ route('terms') }}" target="_blank">Terms of Service</a>.</h6>
      </div>

      <div class="modal-body modal-body-login">
          <form method="post" action="/login" id="login-modal-form">
              <div class="form-group">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Email" />
              </div>
              <div class="form-group">
                  <input type="password" class="form-control" name="password" id="password" placeholder="Password" />
              </div>
              <div class="checkbox">
                  <label>
                      <input type="checkbox"> Remember Me
                  </label>
              </div>
              <button type="submit" class="btn btn-default">Submit</button>
              <input type="hidden" name="_token" value="{{ Session::token() }}"/>
          </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->