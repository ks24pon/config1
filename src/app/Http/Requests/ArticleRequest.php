<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    return [
      'title' => 'required|max:50',
      'tags' => 'json|regex:/^(?!.*\s).+$/u|regex:/^(?!.*\/).*$/u',
      'recruitment_id' => 'required|max:1',
      'test_id' => 'required|max:1',
      'contents_test' => 'required|max:500',
      'other_information' => 'required|max:500',
      'advice_etc' => 'required|max:500',
    ];
  }

  public function attributes()
  {
    return [
      'title' => 'タイトル',
      'tag' => 'タグ',
      'recruitment_id' => '採用形態',
      'test_id' => '試験内容',
      'contents_test' => '試験の内容',
      'othr_information' => 'その他の情報',
      'advice_etc' => 'アドバイスなど',
    ];
  }

  public function passedValidation()
  {
    $this->tags = collect(json_decode($this->tags))
      ->slice(0, 5)
      ->map(function ($requestTag) {
        return $requestTag->text;
      });
  }
}
