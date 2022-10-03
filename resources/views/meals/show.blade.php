<x-app-layout>
    <div class="container lg:w-3/4 md:w-4/5 w-11/12 mx-auto my-8 px-8 py-4 bg-white shadow-md">
        <x-flash-message :message="session('notice')" />
        <article class="mb-2">
            <h2 class="font-bold font-sans break-normal text-gray-900 pt-6 pb-1 text-3xl md:text-4xl">
                {{ $meal->title }}</h2>
            <h3>{{ $meal->user->name }}</h3>
            <p class="text-sm mb-2 md:text-base font-normal text-gray-600">
                現在時刻: <span class="text-red-400 font-bold">{{ date('Y-m-d H:i:s') }}</span>
                記事作成日: {{ $meal->created_at }}
            </p>
            <img src="{{ Storage::url($meal->image_path) }}" alt="" class="mb-4">
            <p class="text-gray-700 text-base">{!! nl2br(e($meal->description)) !!}</p>
        </article>
        @auth
            @if ($favorite)
                <div class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-36 mr-2">
                    <form action="{{ route("meals.favorites.destroy", [$meal, $favorite]) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="お気に入り削除">
                    </form>
                </div>
            @else
                <div class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-28 mr-2">
                    <form action="{{ route("meals.favorites.store", $meal) }}" method="post">
                        @csrf
                        <input type="submit" value="お気に入り">
                    </form>
                </div>
            @endif
            <div>お気に入り数：{{ $favorite_count }}</div>
        @endauth
    <div class="flex flex-row text-center my-4">
        @can('update',$meal)
        <a href="{{ route('meals.edit', $meal) }}"
            class="bg-purple-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-20 mr-2">編集</a>
            @endcan
            @can('delete',$meal)
        <form action="{{ route('meals.destroy', $meal) }}" method="meal">
            @csrf
            @method('DELETE')
            <input type="submit" value="削除" onclick="if(!confirm('削除しますか？')){return false};"
                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-20">
        </form>
        @endcan
    </div>
    </div>
</x-app-layout>
