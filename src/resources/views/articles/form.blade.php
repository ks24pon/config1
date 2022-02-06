@csrf
<div class="md-form">
  <label>タイトル</label>
  <input type="text" name="title" class="form-control" required value="{{ $article->title ?? old('title') }}">
</div>
<div class="form-group">
  <!-- 記事のタグ情報を渡す -->
  <article-tags-input :initial-tags='@json($tagNames ?? [])' :autocomplete-items='@json($allTagNames ?? [])'>
  </article-tags-input>
</div>
<!-- ラジオボタン -->
<div class="mb-4 col-lg-7 col-md-8 col-sm-9 col-xs-10 mx-auto row align-items-center ">
  <span class="col-3 text-center bg orange lighten-1 text-white px-3 py-2 rounded-pill">採用形態</span>
  <div class="col-9 text-left py-2 ">
    <div class="form-check form-check-inline">
      <input type="radio" name='recruitment_id' id="recruitment1" class='form-check-input' value=1 {{ old("recruitment_id") == 1 ? 'checked' : '' }}>
      <label class="form-check-label" for="recruitment1">国家公務員</label>
    </div>
    <div class="form-check form-check-inline">
      <input type="radio" name='recruitment_id' id="recruitment2" class='form-check-input' value=2 {{ old("recruitment_id") == 1 ? 'checked' : '' }}>
      <label class="form-check-label" for="recruitment2">地方公務員</label>
    </div>
  </div>
</div>
<!-- ラジオボタン -->
<div class="mb-4 col-lg-5 col-lg-7 col-md-8 col-sm-9 col-xs-10 mx-auto row align-items-center ">
  <span class="col-3 text-center bg orange lighten-1 text-white px-3 py-2 rounded-pill">試験内容</span>
  <div class="col-9 text-left">
    <div class="form-check form-check-inline">
      <input type="radio" name='test_id' id="test1" class='form-check-input' value=1 {{ old('test_id') == 1 ? 'checked' : '' }}>
      <label class="form-check-label" for="test1">筆記試験</label>
    </div>
    <div class="form-check form-check-inline">
      <input type="radio" name='test_id' id="test2" class='form-check-input' value=2 {{ old('test_id') == 1 ? 'checked' : '' }}>
      <label class="form-check-label" for="test2">面接試験</label>
    </div>
    <div class="form-check form-check-inline">
      <input type="radio" name='test_id' id="test3" class='form-check-input' value=3 {{ old('test_id') == 1 ? 'checked' : '' }}>
      <label class="form-check-label" for="test3">論文作成</label>
    </div>
  </div>
</div>

<div class="card-body form-group text-left col-lg-8 col-md-9 col-sm-10 col-xs-12 mx-auto mt-5">
  <label class="bg orange lighten-1 text-white px-3 py-2 rounded-pill mb-3">試験の内容</label>
  <textarea name="contents_test" class="form-control" required rows="8" placeholder="(例)・筆記試験は数的処理や時事問題が多く出題される">{{ $article->contents_test ?? old('contents_test') }}</textarea>
</div>

<div class="card-body form-group text-left col-lg-8 col-md-9 col-sm-10 col-xs-12 mx-auto mt-4">
  <label class="bg orange lighten-1 text-white px-3 py-2 rounded-pill mb-3">その他の情報</label>
  <textarea name="other_information" class="form-control" required rows="8" placeholder="(例)・試験当日はスリッパなど持って行く方が良い">{{ $article->other_information ?? old('other_information') }}</textarea>
</div>

<div class="card-body form-group text-left col-lg-8 col-md-9 col-sm-10 col-xs-12 mx-auto mt-4">
  <label class="bg orange lighten-1 text-white px-3 py-2 rounded-pill mb-3">アドバイスなど</label>
  <textarea name="advice_etc" class="form-control" required rows="8" placeholder="(例)・筆記試験は私服可が多いので受けやすい服装で行くと良い">{{ $article->advice_etc ?? old('advice_etc') }}</textarea>
</div>
