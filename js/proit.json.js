/*
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/mit-license.php
 *
 */

(function() {
	Raphael.fn.toJSON = function(callback) {
		var
			data,
			elements = new Array,
			paper    = this
			;

		for ( var el = paper.bottom; el != null; el = el.next ) {
			data = callback ? callback(el, new Object) : new Object;

//			if (( data ) && (el.type == "rect")) elements.push({
			if ( data ) elements.push({
				type:      el.type,
				attrs:     el.attrs,
				data:      el.data(),
				transform: el.matrix.toTransformString(),
				id:        el.id
				});
		}

		var cache = [];
		var o = JSON.stringify(elements, function (key, value) {
		    //http://stackoverflow.com/a/11616993/400048
		    if (typeof value === 'object' && value !== null) {
		        if (cache.indexOf(value) !== -1) {
		            // Circular reference found, discard key
		            return;
		        }
		        // Store value in our collection
		        cache.push(value);
		    }
		    return value;
		});
		cache = null;
		return o;
	}

	Raphael.fn.fromJSON = function(json, callback) {
		var
			el,
			paper = this
			;

		if ( typeof json === 'string' ) json = JSON.parse(json);

		for ( var i in json ) {
			if ( json.hasOwnProperty(i) ) {
				el = paper[json[i].type]()
					.attr(json[i].attrs)
					.data(json[i].data)
					.transform(json[i].transform);

				el.id = json[i].id;

				if ( callback ) el = callback(el, json[i].data);

				if ( el ) paper.set().push(el);
			}
		}
	}
})();

