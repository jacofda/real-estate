<div class="card-header bg-secondary-light">
    <div class="row">
        <div class="col-6">
            <div class="form-group ta">
                <input style="width:100%" id="autoComplete" type="text" tabindex="1">@if(request()->has('id'))<a title="reset" href="{{route('properties.index')}}" class="btn btn-danger reset"><i class="fas fa-times"></i></a>@endif
                <div class="selection"></div>
            </div>
        </div>
        <div class="col-6 text-right">

            <div class="card-tools">

                <div class="btn-group" role="group">
                    <a class="btn btn-primary" href="{{route('properties.create')}}"><i class="fas fa-plus"></i> Crea Proprietà</a>
                </div>

            </div>
        </div>
    </div>
</div>

@push('scripts')

    <script src="https://cdn.jsdelivr.net/npm/@tarekraafat/autocomplete.js@7.2.0/dist/js/autoComplete.min.js"></script>
    <script>

    const autoCompletejs = new autoComplete({
    	data: {
    		src: async () => {
    			document.querySelector("#autoComplete").setAttribute("placeholder", "Loading...");
    			const source = await fetch(
    				"{{url('api/ta/properties')}}"
    			);
    			const data = await source.json();
    			document.querySelector("#autoComplete").setAttribute("placeholder", "Cerca Immobili ...");
    			return data;
    		},
    		key: ["text"],
    		cache: false
    	},
    	sort: (a, b) => {
    		if (a.match < b.match) return -1;
    		if (a.match > b.match) return 1;
    		return 0;
    	},
    	placeHolder: "Cerca Immobili",
    	selector: "#autoComplete",
    	threshold: 2,
    	debounce: 0,
    	searchEngine: "strict",
    	highlight: true,
    	maxResults: 5,
    	resultsList: {
    		render: true,
    		container: (source) => {
    			source.setAttribute("id", "autoComplete_list");
    		},
    		destination: document.querySelector("#autoComplete"),
    		position: "afterend",
    		element: "ul"
    	},
    	resultItem: {
    		content: (data, source) => {
    			source.innerHTML = data.match;
    		},
    		element: "li"
    	},
    	noResults: () => {
    		const result = document.createElement("li");
    		result.setAttribute("class", "no_result");
    		result.setAttribute("tabindex", "1");
    		result.innerHTML = "No Results";
    		document.querySelector("#autoComplete_list").appendChild(result);
    	},
    	onSelection: (feedback) => {
    		const selection = feedback.selection.value.name;
    		document.querySelector("#autoComplete").value = "";
    		document.querySelector("#autoComplete").setAttribute("placeholder", selection);
    		console.log(feedback);
            window.location.href = "{{config('app.url')}}properties?id="+feedback.selection.value.id;
    	}
    });

    </script>
@endpush
