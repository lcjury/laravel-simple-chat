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
                        @auth
                            <form id="logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        @endauth
                        <div class="flex h-16">
                                <form class="flex flex-1 rounded-lg border-2 border-grey overflow-hidden" action="{{route('comment.store')}}" method="POST">
                                    {{ csrf_field() }}
                                    @auth
                                        <a id="logout-handler" href="#" class="text-3xl text-grey border-r-2 border-grey p-2">
                                            <svg class="fill-current h-6 w-6 block" viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                                <g id="Page-1" stroke="none" stroke-width="1" fill-rule="evenodd"><g id="icon-shape"><path d="M11.4142136,10 L14.2426407,7.17157288 L12.8284271,5.75735931 L10,8.58578644 L7.17157288,5.75735931 L5.75735931,7.17157288 L8.58578644,10 L5.75735931,12.8284271 L7.17157288,14.2426407 L10,11.4142136 L12.8284271,14.2426407 L14.2426407,12.8284271 L11.4142136,10 L11.4142136,10 Z M2.92893219,17.0710678 C6.83417511,20.9763107 13.1658249,20.9763107 17.0710678,17.0710678 C20.9763107,13.1658249 20.9763107,6.83417511 17.0710678,2.92893219 C13.1658249,-0.976310729 6.83417511,-0.976310729 2.92893219,2.92893219 C-0.976310729,6.83417511 -0.976310729,13.1658249 2.92893219,17.0710678 L2.92893219,17.0710678 Z M4.34314575,15.6568542 C7.46734008,18.7810486 12.5326599,18.7810486 15.6568542,15.6568542 C18.7810486,12.5326599 18.7810486,7.46734008 15.6568542,4.34314575 C12.5326599,1.21895142 7.46734008,1.21895142 4.34314575,4.34314575 C1.21895142,7.46734008 1.21895142,12.5326599 4.34314575,15.6568542 L4.34314575,15.6568542 Z" id="Combined-Shape-Copy"></path></g></g>
                                            </svg>
                                        </a>
                                    @endauth

                                    <input @auth disabled @endauth name="owner" value="{{\Auth::user()->name ?? ''}}" type="text" class="w-1/4 border-r-2 border-grey px-4 @auth bg-grey-lighter @endauth" placeholder="Name" />

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
        function registerLogoutHandler() {
            const handler = document.getElementById('logout-handler');
            if(handler == null) {
                return;
            }
            handler.onclick = function(event) {
                event.preventDefault();
                document.getElementById('logout').submit();
            }
        }

        function scrollToBottom(elementId) {
            const element = document.getElementById(elementId);
            element.scrollTop = element.scrollHeight;
        }

        registerLogoutHandler();
        scrollToBottom('chat');
    </script>
</html>
