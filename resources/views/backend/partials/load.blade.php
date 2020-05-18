
<div id="load" style="position: relative;">
    @foreach($articles as $article)
        <div>
            <h3>
                <a href="{{ action('ArticleController@show', [$article->id]) }}">{{$article->title }}</a>
            </h3>
        </div>
    @endforeach
</div>
{{ $articles->links() }}