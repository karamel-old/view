<?php

namespace Karamel\Http;

use Karamel\Validation\Exceptions\ValidationException;
use Karamel\Validation\Validation;

abstract class Controller
{
    protected function validate(Request $request, $roles = [])
    {
        try {
            Validation::make($request->all(), $roles);
        } catch (ValidationException $validationException) {
            //return back
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage(), $exception->getCode(), $exception);
        }
    }
}