{{--

    * Created by   :  Muhammad Yasir
    * Project Name : shalmi
    * Product Name : PhpStorm
    * Date         : 14-Dec-16 4:33 PM
    * File Name    : 

--}}
Received a contact request from {{$data['detail']['first_name'].' '. $data['detail']['last_name']}}
<br>
<br>
<br>
<b>Company: </b> {{$data['detail']['company']}}<br><br>
<b>Company Name: </b> {{$data['detail']['company_title']}}<br><br>
<b>Mobile No: </b> {{$data['detail']['phone']}}<br><br>
<b>Country/Region: </b> {{getCountryName($data['detail']['country'])}}<br><br><br>
<b>Detail: </b> <p>
    {{$data['detail']['detail']}}
</p>
