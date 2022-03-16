<div>
    <h2> Здравствуйте, {{ $student->fullName}} </h2>
     Вы были зарегистрирован на нашем учебном портале <br>
            Для входа необходимо использовать следующие данные. <br>
             <b> email: </b>  {{ $student->email}} <br>
             <b>password :</b> {{ $password }}
</div>