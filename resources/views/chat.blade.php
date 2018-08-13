<html>
    <head>
        <title>Chat </title>
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="container mx-auto">
            <div class="font-sans antialiased h-screen flex">
                <div class="flex-1 flex flex-col bg-white overflow-hidden">
                    <div id="chat" class="px-6 py-4 flex-1 overflow-y-scroll">
                        @foreach($comments as $comment)
                        <div class="flex items-start mb-4 text-sm">
                            <div class="flex-1 overflow-hidden">
                                <div>
                                    <span class="font-bold">{{$comment->owner}}</span>
                                    <span class="text-grey text-xs">{{$comment->created_at}}</span>
                                </div>
                                <p class="text-black leading-normal">{{$comment->content}}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="pb-6 px-4 flex-none">
                        <div class="flex h-16">
                                <form class="flex flex-1 rounded-lg border-2 border-grey overflow-hidden" action="{{route('comment.store')}}" method="POST">
                                    {{ csrf_field() }}
                                    <input name="owner" value="" type="text" class="w-1/4 border-r-2 border-grey px-4" placeholder="Name" />

                                <input name="content" type="text" class="w-full px-4" placeholder="Message" />
                                <button class="bg-blue hover:bg-blue-dark text-white font-bold py-2 px-4 rounded">Enviar </button>
                                </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script>
        function scrollToBottom(elementId) {
            const element = document.getElementById(elementId);
            element.scrollTop = element.scrollHeight;
        }
        scrollToBottom('chat');
    </script>
</html>
