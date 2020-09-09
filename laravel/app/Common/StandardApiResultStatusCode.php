<?php
namespace App\Common;
abstract class StandardApiResultStatusCode{
    const Succees = 0;
    const ServerError = 1;
    const BadRequest = 2;
    const NotFound = 3;
    const ListEmpty = 4;
    const LogicError = 5;
    const UnAuthorized = 6;

    const defaultMessages = [
        'عملیات موفقیت آمیز بود',
        'خطایی در سرور رخ داده است',
        'پارامتر های ارسالی معتبر نیستند',
        'یافت نشد',
        'لیست خالی است',
        'خطایی در پردازش رخ داد',
        'خطای احراز هویت',
    ];
}