<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * Class Valida
 *
 * Validation helper
 *
 * @author Guilherme Kulik
 */
class Valida
{
    protected $feedback = [];
    protected $rules = [];
    protected $errors = [];

    public function __construct(Request $r, string $f) // request and the current form
    {
        $this->setConfig($r, $f); // valida ja na construção da classe
    }

    public function setFeedback($feedback) {
        $this->feedback = $feedback ;
    }

    public function getFeedback() {
        return $this->feedback;
    }

    public function setRules($rules) {
        $this->rules = $rules;
    }
    public function getRules() {
        return $this->rules;
    }

    public function setErrors($errors) {
        return $this->errors;
    }

    public function getErrors() {
        return $this->errors;
    }

    private function setConfig(Request $r, string $f): void
    {
        switch ($f) 
        {
            case 'food-store':

                $formRules = [
                    'name'              => 'required|string|min:3|max:255',
                    'category_id'       => 'required|exists:food_categories,id',
                    'foodIngredients'   => 'required', 
                ];

                $formFeedback = [
                    'name.required'               => __("messages.validation.feedback.name.required"),
                    'category_id.required'        => __("messages.validation.feedback.category.required"),
                    'unique'                      => __("messages.validation.feedback.name.unique"), 
                    'max'                         => __("messages.validation.feedback.name.max"),
                    'name.min'                         => __("messages.validation.feedback.name.min"),
                    'foodIngredients.required'    => __('messages.validation.ingredient.required'),
                ];

            break;

            case 'food-update':

                $formRules = [
                    'name'              => 'required|string|min:3|max:255|',
                    'category_id'       => 'required|exists:food_categories,id',
                ];

                $formFeedback = [
                    'name.required'               => __("messages.validation.feedback.name.required"),
                    'category_id.required'        => __("messages.validation.feedback.category.required"),
                    'unique'                      => __("messages.validation.feedback.name.unique"), 
                    'max'                         => __("messages.validation.feedback.name.max"),
                    'name.min'                    => __("messages.validation.feedback.name.min"),
                ];
            break;
        }
        
        $this->setRules($formRules);
        $this->setFeedback($formFeedback);
    }

    public function errorCheck(Request $r)
    {
        $v = Validator::make($r->all(), $this->getRules(), $this->getFeedback());
    
        if ($v->fails()) 
        {
            $errors = $v->errors()->all();
            $this->setErrors($errors);

            foreach ($errors as $error) {
                Notify::error($error);
            }
    
            return $errors;
        }
    
        return true;
    }
}
