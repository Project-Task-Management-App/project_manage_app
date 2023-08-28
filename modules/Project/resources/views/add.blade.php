@extends('layouts.layout')

@section('title', 'Add Project')
    
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/add_project.css')}}">
@endsection

@section('content')
    <div class="add-project w-100 d-flex justify-content-center mt-2 mb-4">

        <div class="add-form d-flex flex-column align-items-center">

            <div class="add-label w-100"> Create new project </div>
    
            <form method="POST" action="{{ route('login') }}" class="d-flex flex-column w-100">  
    
                <div class="mb-3">
                    <label for="name"> {{ __('Name') }} </label>
    
                    <div>
                        <input id="name" type="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required placeholder="Name..." autocomplete="name" autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    
                </div>
    
                <div class="mb-3">
                    <label for="priority"> {{ __('Priority') }} </label>
                    <div>
                        <select name="priority" id="priority" class="form-select {{$errors->has('priority')? 'is-invalid' :''}}">
                            <option value="0">Select priority</option>
                            <option value="high">High</option>
                            <option value="medium">Medium</option>
                            <option value="low">Low</option>
                        </select>
                        @error('priority')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>                    
                </div>
    
                <div class="mb-3 d-flex justify-content-between">
    
                    <div class="date">
                        <label for="startdate"> {{ __('Start date') }} </label>
                        <div>
                            <input id="startdate" type="date" class="form-control @error('startdate') is-invalid @enderror" name="startdate" value="{{ old('startdate') }}" required>
                            @error('startdate')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="date">
                        <label for="duedate"> {{ __('Due date') }} </label>
                        <div>
                            <input id="duedate" type="date" class="form-control @error('duedate') is-invalid @enderror" name="duedate" value="{{ old('duedate') }}" required>
                            @error('duedate')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    
                </div>
    
                <div class="mb-3">
                    <div class="d-flex justify-content-between">
                        <label for="invite"> {{ __('Invite the coworkers') }} </label>
                        <img class="add-email" src="{{asset('img/plus_color.png')}}" alt="" srcset="">
                    </div>
                    
                    <div class="invites">
                        <input id="invite" type="email" class="form-control invite" name="email[]" autocomplete="email" placeholder="Email of coworkers...">
                    </div>
                </div>
    
                <div class="mb-3">
                    <label for="comment"> {{ __('Comment') }} </label>
                    <div>
                        <textarea name="comment" id="comment" rows="4" class="form-control" placeholder="Comments..."></textarea>
                    </div>
                </div>
    
                <div class="actions d-flex justify-content-evenly">
    
                    <button type="submit" class="btn btn-primary">
                        {{ __('Create') }}
                    </button>
                    
                    <button type="reset" class="btn btn-warning">
                        {{ __('Reset') }}
                    </button>
                    
                    <a href="#" class="btn btn-danger">{{ __('Cancel') }}</a>
    
                </div>
                
    
                @csrf
                @method('POST')
            </form>
    
        </div>

    </div>
@endsection

@section('script')
    <script type="text/javascript">

      /******************************************** Add coworker emails *********************************************/

        // Alert email error
        const emailAlert = function(logic, text){
            if (!logic) {
                    text.classList.remove('border-success');
                    text.classList.add('border-danger');
                } else {
                    text.classList.remove('border-danger');
                    text.classList.add('border-success');
                }
        }

        // Email validation 
        const emailPattern = /^[A-z][A-z0-9_\.\-]{2,}@[A-z0-9\-]{2,}(\.[A-z]{2,}){1,2}$/;
        const checkEmails = function(textArray) {
            let check = true;
            textArray.forEach(text=>{
                check*=emailPattern.test(text.value);
                if (text.value != '') {
                    emailAlert(emailPattern.test(text.value), text);
                }
                
            });
            return check;
        }

        //
        const checkEmail = function() {
            let inviteInputs = document.querySelectorAll('.invite');
            inviteInputs.forEach(inviteInput => {
                inviteInput.onchange = () => {
                    emailAlert(emailPattern.test(inviteInput.value), inviteInput);
                }
            });
        }
        checkEmail();


        // create an input element 
        const createInputItem = function(count) {
            let input = document.createElement('input')
            input.setAttribute('id', 'invite_'+count);
            input.setAttribute('type', 'email');
            input.setAttribute('class', 'form-control mt-1 invite');
            input.setAttribute('name', 'email[]');
            input.setAttribute('placeholder', 'Email of coworkers...');
            input.setAttribute('autocomplete', 'email');
            return input;
        }

        const addEmail = document.querySelector('.add-email');
        let count = 1;
        // Add un email input if emails are correct
        addEmail.onclick = () => {
            let inviteInputs = document.querySelectorAll('.invite');
            if (checkEmails(inviteInputs)) {
                document.querySelector('.invites').appendChild(createInputItem(count));
                count++;

                // check email
                checkEmail();
            }
        }
      /**************************************************************************************************************/

    </script>
@endsection