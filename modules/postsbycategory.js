import axios from "axios";
import  'regenerator-runtime/runtime';
function getPages(apiQueryParam){
	console.log(apiQueryParam);
	const pages = (
		await axios.get(`https:3000/deliberatedoing/wp-json/coaching/v1/testimonials?page=${apiQueryParam}`)
		).data
	// const pages = (await axios.get(`https:3000/deliberatedoing/wp-json/coaching/v1/posts?category_name=${apiQueryParam}`)).data
	return pages
}
