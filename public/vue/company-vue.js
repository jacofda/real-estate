// Vue.filter('formatDate', function(d) {
// 	if(!window.Intl) return d;
// 	return new Intl.DateTimeFormat('en-US').format(new Date(d));
// });

const app = new Vue({
	el:'#app',
	data:{
		term:'',
		results:[],
		noResults:false,
		searching:false,
		audio:null
	},
	methods:{
		search:function() {
			this.searching = true;
			fetch(`http://localhost/crm/public/api/ta/companies/${encodeURIComponent(this.term)}`)
			.then(res => res.json())
			.then(res => {
				this.searching = false;
				this.results = res.results;
				this.noResults = this.results.length === 0;
			});
		}
	}
});
