<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
    @if (Auth::guest())
    <form role="form" method="POST" action="{{ route('login') }}">
    {{ csrf_field() }}
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">@lang('auth.login.login')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="email">@lang('auth.email')</label>
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        @if ($errors->has('email'))
                        <span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
                        @endif
                        <input type="text" class="form-control underlined" id="email" name="email" 
                        placeholder="@lang('auth.ph_email')" value="{{ old('email') }}" required autofocus/>
                    </div>
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password">@lang('auth.password')</label>
                        @if ($errors->has('password'))
                        <span class="help-block"><strong>{{ $errors->first('password') }}</strong></span>
                        @endif
                        <input type="password" class="form-control underlined" id="password" 
                        name="password" placeholder="@lang('auth.ph_password')"/>
                    </div>
                    <div class="form-group">
                        <label for="remember">
                            <input class="checkbox" id="remember" type="checkbox" 
                            {{ old('remember') ? 'checked' : '' }}>
                            <span>@lang('auth.login.remember')</span>
                        </label>
                        {{--  <a href="reset.html" class="forgot-btn pull-right">Forgot password?</a>  --}}
                    </div>
                </div>
                <div class="modal-footer">
                    <p class="text-muted text-center">@lang('auth.register.question')
                        <a href="{{route('register')}}">@lang('auth.register.prompt')</a>
                    </p>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('general.form.close')</button>
                    {{--  <button type="button" class="btn btn-primary">Save changes</button>  --}}
                    <button type="submit" class="btn btn-primary">@lang('auth.login.login')</button>
                </div>
            </div>
        </div>
    </form>
    @endif
</div>