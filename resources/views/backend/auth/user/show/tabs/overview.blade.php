<div class="row">
    <div class="col-md-4">
        <h4 class="text-center">Basic Details <a href="{{ route('admin.auth.user.edit', $user) }}"
                style="float: right; color: #086d9b;"><i class="fa fa-pencil"></i></a></h4>
        <div class="table-responsive">
            <table class="table table-hover" style="border: 1px solid #c8ced3;">
                <tr>
                    <th>@lang('labels.backend.access.users.tabs.content.overview.avatar')</th>
                    @if($user->avatar_type=='upload')
                    <td>
                    @if(isset($user->avatar_location) && !empty($user->avatar_location) && file_exists(public_path($user->avatar_location)))
                    <img src="{{asset('/') . $user->avatar_location }}" class="user-profile-image" width="150"/></td>
                    @else
                        NO Image
                    @endif 
                    @else
                    <td>
                    @if(isset($user->picture) && !empty($user->picture) && file_exists($user->picture))
                        <img src="{{ $user->picture }}" class="user-profile-image" />
                    @else
                    {{ substr(ucfirst($user->full_name), 0, 1) }}
                    @endif    
                    </td>

                    @endif
                </tr>
                <tr>
                    <th>Pronouns</th>
                    <td>{{ $user->pronouns_text }}</td>
                </tr>

                <tr>
                    <th>@lang('labels.backend.access.users.tabs.content.overview.first_name')</th>
                    <td>{{ $user->first_name }}</td>
                </tr>
                <tr>
                    <th>@lang('labels.backend.access.users.tabs.content.overview.last_name')</th>
                    <td>{{ $user->last_name }}</td>
                </tr>

                <tr>
                    <th>@lang('labels.backend.access.users.tabs.content.overview.email')</th>
                    <td>{{ $user->email }}</td>
                </tr>
                <tr>
                    <th>@lang('validation.attributes.backend.access.users.mobile_no')</th>
                    <td>
                        @if ($user->mobile_no)
                            <a href="tel:{{ $user->mobile_no }}">+{{ $user->dialing_code }}-{{ $user->mobile_no }}</a>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Sex Assigned At Birth</th>
                    <td>
                        {{ ucfirst($user->gender) }}
                    </td>
                </tr>
                <tr>
                    <th>Gender Identity</th>
                    <td>
                        {{ ucfirst($user->gender_identity) }}
                    </td>
                </tr>
                <tr>
                    <th>Self Described</th>
                    <td>
                        {{ $user->self_described }}
                    </td>
                </tr>
                <tr>
                    <th>@lang('validation.attributes.backend.access.users.d_o_b')</th>
                    <td>
                        {{ ucfirst($user->date_of_birth) }}
                    </td>
                </tr>
                <tr>
                    <th>@lang('Health card No')</th>
                    <td>
                   @if(isset($user->healthcard->card_number))
                        {{  Str::upper($user->healthcard->card_number) }}
                        @endif
                    </td>
                </tr>
                
                <tr>
                    <th>@lang('validation.attributes.backend.access.users.province')</th>
                    <td>
                        {{ ucfirst($user->province) }}
                    </td>
                </tr>
                
                
                <tr>
                    <th>@lang('labels.backend.access.users.tabs.content.overview.status')</th>
                    <td>@include('backend.auth.user.includes.status', ['user' => $user])</td>
                </tr>
               
            </table>
        </div>
    </div>
    <!--table-responsive-->
     @include('backend.auth.user.includes.prescriptions')
     
</div>
  @include('backend.auth.user.includes.patient-css')
  @include('backend.auth.user.includes.patient-js')
