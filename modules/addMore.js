import axios from "axios"
export default{
  name: 'Testimonials',
  data() {
	return {
	  videosUrl: 'http://localhost/deliberatedoing/wp-json/coaching/v1/testimonials/?_embed',
	  queryOptions: {
		per_page: 2,
		page: 1,
		offset: 1,
		_embed: true
	  },
	  videos: [],
	}
  },
  methods: {
	getRecentVideos() {
	  axios
		.get(this.videosUrl, { params: this.queryOptions })
		.then(response => {
		  this.videos = response.data;
		})
	},
	addMoreVideos: function() {
	  this.queryOptions.page += 1
	  this.getRecentVideos();
	}      
  },
  mounted() {
	this.getRecentVideos();
  }
}
