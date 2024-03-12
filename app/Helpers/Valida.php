<?php

namespace App\Helpers;

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

    public function __construct(Request $r, string $f) // request and the current form
    {
        v($r, $f); // valida ja na construção da classe
    }

    private function v(Request $r, string $f)
    {
        switch ($form) 
        {
            case 'food-store':
                $this->rules = [
                    'name'              => 'required|string|min:3|max:255|unique:foods',
                    'category_id'       => 'required|exists:food_categories,id',
                    'foodIngredients'   => 'required', // Verifica se é um array
                ];

                $this->$feedback = [
                    'name.required'               => __("messages.validation.feedback.name.required"),
                    'category_id.required'        => __("messages.validation.feedback.category.required"),
                    'unique'                      => __("messages.validation.feedback.name.unique"), 
                    'max'                         => __("messages.validation.feedback.name.max"),
                    'min'                         => __("messages.validation.feedback.name.min"),
                    'foodIngredients.required'       => __('messages.validation.ingredient.required'),
                ];
                break;

            case 'food-update':
                $this->$rules = [
                    'name'              => 'required|string|min:3|max:255|unique:foods',
                    'category_id'       => 'required|exists:food_categories,id',
                    'foodIngredients'   => 'required', // Verifica se é um array
                ];        
        
                $feedback = [
                    'name.required'               => __("messages.validation.feedback.name.required"),
                    'category_id.required'        => __("messages.validation.feedback.category.required"),
                    'unique'                      => __("messages.validation.feedback.name.unique"), 
                    'max'                         => __("messages.validation.feedback.name.max"),
                    'min'                         => __("messages.validation.feedback.name.min"),
                    'foodIngredients.required'       => __('messages.validation.ingredient.required'),
                ];
                break;
        }
        
        errorCheck($r, $f);
    }

    private function errorCheck(Request $r, Validator $v) 
    {
        $r = Validator::make($request->all(), $rules, $feedback);

        // Verifique se a validação falhou
        if ($validator->fails()) {
            // Mapeie os erros para as mensagens personalizadas
            $errors = [];
            foreach ($validator->errors()->all() as $error) {
                $errors[] = $error;
            }

            // Configure a notificação flash com os erros de validação
            foreach ($errors as $error) {
                Notify::error($error);
            }

            // Retorne a resposta com os erros de validação
            return response()->json(['redirect_url' => route('food.index')]);
        }
    }
}
