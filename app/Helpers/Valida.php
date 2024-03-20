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

    public function __construct(Request $request, string $form) // request and the current form
    {
        $this->setConfig($request, $form); // valida ja na construção da classe
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

    private function setConfig(Request $request, string $form): void
    {
        switch ($form) 
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

            case 'meal-store':

                $formRules = [
                    'title'              => 'required|string|min:3|max:255|',
                    'notes'       => 'required|string|min:1|max:255|',
                ];

                $formFeedback = [
                    'title.required'               => __("messages.validation.feedback.name.required"),
                ];

            break;
        }
        
        $this->setRules($formRules);
        $this->setFeedback($formFeedback);
    }

    public function errorCheck(Request $request)
    {
        $validator = Validator::make($request->all(), $this->getRules(), $this->getFeedback());
    
        if ($validator->fails()) 
        {
            $errors = $validator->errors()->all();
            $this->setErrors($errors);

            foreach ($errors as $error) {
                Notify::error($error);
            }
    
            return $errors;
        }
    
        return true;
    }
}
