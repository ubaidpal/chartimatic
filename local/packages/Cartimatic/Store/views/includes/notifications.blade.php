{{--

    * Created by   :  Muhammad Yasir
    * Project Name : shalmi
    * Product Name : PhpStorm
    * Date         : 30-Aug-16 6:02 PM
    * File Name    : 

--}}
<li role="presentation" class="dropdown">
    {{--<a href="{{url('admin/store/notifications')}}" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">--}}
    <a href="{{url('admin/store/notifications')}}" class="info-number">
        <i class="fa fa-envelope-o"></i>
        <?php $count = countNotifications($user->id); ?>
        @if($count > 0)
            <span class="badge bg-green">{{$count}}</span>
        @endif
    </a>
</li>
<li role="presentation" class="dropdown">

    <a href="{{url('messages/seller-messages')}}" class="info-number">
        <i class="fa fa-bell-o"></i>
        <?php $count = countNotifications($user->id); ?>
        @if($count > 0)
            <span class="badge bg-green">{{$count}}</span>
        @endif
    </a>
    {{-- <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
         <li>
             <a>
                       <span class="image">
                                         <img src="images/img.jpg" alt="Profile Image"/>
                                     </span>
                 <span>
                                         <span>John Smith</span>
                       <span class="time">3 mins ago</span>
                       </span>
                 <span class="message">
                                         Film festivals used to be do-or-die moments for movie makers. They were where...
                                     </span>
             </a>
         </li>
         <li>
             <a>
                       <span class="image">
                                         <img src="images/img.jpg" alt="Profile Image"/>
                                     </span>
                 <span>
                                         <span>John Smith</span>
                       <span class="time">3 mins ago</span>
                       </span>
                 <span class="message">
                                         Film festivals used to be do-or-die moments for movie makers. They were where...
                                     </span>
             </a>
         </li>
         <li>
             <a>
                       <span class="image">
                                         <img src="images/img.jpg" alt="Profile Image"/>
                                     </span>
                 <span>
                                         <span>John Smith</span>
                       <span class="time">3 mins ago</span>
                       </span>
                 <span class="message">
                                         Film festivals used to be do-or-die moments for movie makers. They were where...
                                     </span>
             </a>
         </li>
         <li>
             <a>
                       <span class="image">
                                         <img src="images/img.jpg" alt="Profile Image"/>
                                     </span>
                 <span>
                                         <span>John Smith</span>
                       <span class="time">3 mins ago</span>
                       </span>
                 <span class="message">
                                         Film festivals used to be do-or-die moments for movie makers. They were where...
                                     </span>
             </a>
         </li>
         <li>
             <div class="text-center">
                 <a>
                     <strong>See All Alerts</strong>
                     <i class="fa fa-angle-right"></i>
                 </a>
             </div>
         </li>
     </ul>--}}
</li>
