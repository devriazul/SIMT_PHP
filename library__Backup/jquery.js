// JavaScript Document
(function(){
/*
 * jQuery 1.2.6 - New Wave Javascript
 *
 * Copyright (c) 2008 John Resig (jquery.com)
 * Dual licensed under the MIT (MIT-LICENSE.txt)
 * and GPL (GPL-LICENSE.txt) licenses.
 *
 * $Date: 2008-05-27 21:17:26 +0200 (Di, 27 Mai 2008) $
 * $Rev: 5700 $
 */

// Map over jQuery in case of overwrite
var _jQuery = window.jQuery,
// Map over the $ in case of overwrite
        _$ = window.$;

var jQuery = window.jQuery = window.$ = function( selector, context ) {
        // The jQuery object is actually just the init constructor 'enhanced'
        return new jQuery.fn.init( selector, context );
};

// A simple way to check for HTML strings or ID strings
// (both of which we optimize for)
var quickExpr = /^[^<]*(<(.|\s)+>)[^>]*$|^#(\w+)$/,

// Is it a simple selector
        isSimple = /^.[^:#\[\.]*$/,

// Will speed up references to undefined, and allows munging its name.
        undefined;

jQuery.fn = jQuery.prototype = {
        init: function( selector, context ) {
                // Make sure that a selection was provided
                selector = selector || document;

                // Handle $(DOMElement)
                if ( selector.nodeType ) {
                        this[0] = selector;
                        this.length = 1;
                        return this;
                }
                // Handle HTML strings
                if ( typeof selector == "string" ) {
                        // Are we dealing with HTML string or an ID?
                        var match = quickExpr.exec( selector );

                        // Verify a match, and that no context was specified for #id
                        if ( match && (match[1] || !context) ) {

                                // HANDLE: $(html) -> $(array)
                                if ( match[1] )
                                        selector = jQuery.clean( [ match[1] ], context );

                                // HANDLE: $("#id")
                                else {
                                        var elem = document.getElementById( match[3] );

                                        // Make sure an element was located
                                        if ( elem ){
                                                // Handle the case where IE and Opera return items
                                                // by name instead of ID
                                                if ( elem.id != match[3] )
                                                        return jQuery().find( selector );

                                                // Otherwise, we inject the element directly into the jQuery object
                                                return jQuery( elem );
                                        }
                                        selector = [];
                                }

                        // HANDLE: $(expr, [context])
                        // (which is just equivalent to: $(content).find(expr)
                        } else
                                return jQuery( context ).find( selector );

                // HANDLE: $(function)
                // Shortcut for document ready
                } else if ( jQuery.isFunction( selector ) )
                        return jQuery( document )[ jQuery.fn.ready ? "ready" : "load" ]( selector );

                return this.setArray(jQuery.makeArray(selector));
        },

        // The current version of jQuery being used
        jquery: "1.2.6",

        // The number of elements contained in the matched element set
        size: function() {
                return this.length;
        },

        // The number of elements contained in the matched element set
        length: 0,

        // Get the Nth element in the matched element set OR
        // Get the whole matched element set as a clean array
        get: function( num ) {
                return num == undefined ?

                        // Return a 'clean' array
                        jQuery.makeArray( this ) :

                        // Return just the object
                        this[ num ];
        },

        // Take an array of elements and push it onto the stack
        // (returning the new matched element set)
        pushStack: function( elems ) {
                // Build a new jQuery matched element set
                var ret = jQuery( elems );

                // Add the old object onto the stack (as a reference)
                ret.prevObject = this;

                // Return the newly-formed element set
                return ret;
        },

        // Force the current matched set of elements to become
        // the specified array of elements (destroying the stack in the process)
        // You should use pushStack() in order to do this, but maintain the stack
        setArray: function( elems ) {
                // Resetting the length to 0, then using the native Array push
                // is a super-fast way to populate an object with array-like properties
                this.length = 0;
                Array.prototype.push.apply( this, elems );

                return this;
        },

        // Execute a callback for every element in the matched set.
        // (You can seed the arguments with an array of args, but this is
        // only used internally.)
        each: function( callback, args ) {
                return jQuery.each( this, callback, args );
        },

        // Determine the position of an element within
        // the matched set of elements
        index: function( elem ) {
                var ret = -1;

                // Locate the position of the desired element
                return jQuery.inArray(
                        // If it receives a jQuery object, the first element is used
                        elem && elem.jquery ? elem[0] : elem
                , this );
        },

        attr: function( name, value, type ) {
                var options = name;

                // Look for the case where we're accessing a style value
                if ( name.constructor == String )
                        if ( value === undefined )
                                return this[0] && jQuery[ type || "attr" ]( this[0], name );

                        else {
                                options = {};
                                options[ name ] = value;
                        }

                // Check to see if we're setting style values
                return this.each(function(i){
                        // Set all the styles
                        for ( name in options )
                                jQuery.attr(
                                        type ?
                                                this.style :
                                                this,
                                        name, jQuery.prop( this, options[ name ], type, i, name )
                                );
                });
        },

        css: function( key, value ) {
                // ignore negative width and height values
                if ( (key == 'width' || key == 'height') && parseFloat(value) < 0 )
                        value = undefined;
                return this.attr( key, value, "curCSS" );
        },

        text: function( text ) {
                if ( typeof text != "object" && text != null )
                        return this.empty().append( (this[0] && this[0].ownerDocument || document).createTextNode( text ) );

                var ret = "";

                jQuery.each( text || this, function(){
                        jQuery.each( this.childNodes, function(){
                                if ( this.nodeType != 8 )
                                        ret += this.nodeType != 1 ?
                                                this.nodeValue :
                                                jQuery.fn.text( [ this ] );
                        });
                });

                return ret;
        },

        wrapAll: function( html ) {
                if ( this[0] )
                        // The elements to wrap the target around
                        jQuery( html, this[0].ownerDocument )
                                .clone()
                                .insertBefore( this[0] )
                                .map(function(){
                                        var elem = this;

                                        while ( elem.firstChild )
                                                elem = elem.firstChild;

                                        return elem;
                                })
                                .append(this);

                return this;
        },

        wrapInner: function( html ) {
                return this.each(function(){
                        jQuery( this ).contents().wrapAll( html );
                });
        },

        wrap: function( html ) {
                return this.each(function(){
                        jQuery( this ).wrapAll( html );
                });
        },

        append: function() {
                return this.domManip(arguments, true, false, function(elem){
                        if (this.nodeType == 1)
                                this.appendChild( elem );
                });
        },

        prepend: function() {
                return this.domManip(arguments, true, true, function(elem){
                        if (this.nodeType == 1)
                                this.insertBefore( elem, this.firstChild );
                });
        },

        before: function() {
                return this.domManip(arguments, false, false, function(elem){
                        this.parentNode.insertBefore( elem, this );
                });
        },

        after: function() {
                return this.domManip(arguments, false, true, function(elem){
                        this.parentNode.insertBefore( elem, this.nextSibling );
                });
        },

        end: function() {
                return this.prevObject || jQuery( [] );
        },

        find: function( selector ) {
                var elems = jQuery.map(this, function(elem){
                        return jQuery.find( selector, elem );
                });

                return this.pushStack( /[^+>] [^+>]/.test( selector ) || selector.indexOf("..") > -1 ?
                        jQuery.unique( elems ) :
                        elems );
        },

        clone: function( events ) {
                // Do the clone
                var ret = this.map(function(){
                        if ( jQuery.browser.msie && !jQuery.isXMLDoc(this) ) {
                                // IE copies events bound via attachEvent when
                                // using cloneNode. Calling detachEvent on the
                                // clone will also remove the events from the orignal
                                // In order to get around this, we use innerHTML.
                                // Unfortunately, this means some modifications to
                                // attributes in IE that are actually only stored
                                // as properties will not be copied (such as the
                                // the name attribute on an input).
                                var clone = this.cloneNode(true),
                                        container = document.createElement("div");
                                container.appendChild(clone);
                                return jQuery.clean([container.innerHTML])[0];
                        } else
                                return this.cloneNode(true);
                });

                // Need to set the expando to null on the cloned set if it exists
                // removeData doesn't work here, IE removes it from the original as well
                // this is primarily for IE but the data expando shouldn't be copied over in any browser
                var clone = ret.find("*").andSelf().each(function(){
                        if ( this[ expando ] != undefined )
                                this[ expando ] = null;
                });

                // Copy the events from the original to the clone
                if ( events === true )
                        this.find("*").andSelf().each(function(i){
                                if (this.nodeType == 3)
                                        return;
                                var events = jQuery.data( this, "events" );

                                for ( var type in events )
                                        for ( var handler in events[ type ] )
                                                jQuery.event.add( clone[ i ], type, events[ type ][ handler ], events[ type ][ handler ].data );
                        });

                // Return the cloned set
                return ret;
        },

        filter: function( selector ) {
                return this.pushStack(
                        jQuery.isFunction( selector ) &&
                        jQuery.grep(this, function(elem, i){
                                return selector.call( elem, i );
                        }) ||

                        jQuery.multiFilter( selector, this ) );
        },

        not: function( selector ) {
                if ( selector.constructor == String )
                        // test special case where just one selector is passed in
                        if ( isSimple.test( selector ) )
                                return this.pushStack( jQuery.multiFilter( selector, this, true ) );
                        else
                                selector = jQuery.multiFilter( selector, this );

                var isArrayLike = selector.length && selector[selector.length - 1] !== undefined && !selector.nodeType;
                return this.filter(function() {
                        return isArrayLike ? jQuery.inArray( this, selector ) < 0 : this != selector;
                });
        },

        add: function( selector ) {
                return this.pushStack( jQuery.unique( jQuery.merge(
                        this.get(),
                        typeof selector == 'string' ?
                                jQuery( selector ) :
                                jQuery.makeArray( selector )
                )));
        },

        is: function( selector ) {
                return !!selector && jQuery.multiFilter( selector, this ).length > 0;
        },

        hasClass: function( selector ) {
                return this.is( "." + selector );
        },

        val: function( value ) {
                if ( value == undefined ) {

                        if ( this.length ) {
                                var elem = this[0];

                                // We need to handle select boxes special
                                if ( jQuery.nodeName( elem, "select" ) ) {
                                        var index = elem.selectedIndex,
                                                values = [],
                                                options = elem.options,
                                                one = elem.type == "select-one";

                                        // Nothing was selected
                                        if ( index < 0 )
                                                return null;

                                        // Loop through all the selected options
                                        for ( var i = one ? index : 0, max = one ? index + 1 : options.length; i < max; i++ ) {
                                                var option = options[ i ];

                                                if ( option.selected ) {
                                                        // Get the specifc value for the option
                                                        value = jQuery.browser.msie && !option.attributes.value.specified ? option.text : option.value;

                                                        // We don't need an array for one selects
                                                        if ( one )
                                                                return value;

                                                        // Multi-Selects return an array
                                                        values.push( value );
                                                }
                                        }

                                        return values;

                                // Everything else, we just grab the value
                                } else
                                        return (this[0].value || "").replace(/\r/g, "");

                        }

                        return undefined;
                }

                if( value.constructor == Number )
                        value += '';

                return this.each(function(){
                        if ( this.nodeType != 1 )
                                return;

                        if ( value.constructor == Array && /radio|checkbox/.test( this.type ) )
                                this.checked = (jQuery.inArray(this.value, value) >= 0 ||
                                        jQuery.inArray(this.name, value) >= 0);

                        else if ( jQuery.nodeName( this, "select" ) ) {
                                var values = jQuery.makeArray(value);

                                jQuery( "option", this ).each(function(){
                                        this.selected = (jQuery.inArray( this.value, values ) >= 0 ||
                                                jQuery.inArray( this.text, values ) >= 0);
                                });

                                if ( !values.length )
                                        this.selectedIndex = -1;

                        } else
                                this.value = value;
                });
        },

        html: function( value ) {
                return value == undefined ?
                        (this[0] ?
                                this[0].innerHTML :
                                null) :
                        this.empty().append( value );
        },

        replaceWith: function( value ) {
                return this.after( value ).remove();
        },

        eq: function( i ) {
                return this.slice( i, i + 1 );
        },

        slice: function() {
                return this.pushStack( Array.prototype.slice.apply( this, arguments ) );
        },

        map: function( callback ) {
                return this.pushStack( jQuery.map(this, function(elem, i){
                        return callback.call( elem, i, elem );
                }));
        },

        andSelf: function() {
                return this.add( this.prevObject );
        },

        data: function( key, value ){
                var parts = key.split(".");
                parts[1] = parts[1] ? "." + parts[1] : "";

                if ( value === undefined ) {
                        var data = this.triggerHandler("getData" + parts[1] + "!", [parts[0]]);

                        if ( data === undefined && this.length )
                                data = jQuery.data( this[0], key );

                        return data === undefined && parts[1] ?
                                this.data( parts[0] ) :
                                data;
                } else
                        return this.trigger("setData" + parts[1] + "!", [parts[0], value]).each(function(){
                                jQuery.data( this, key, value );
                        });
        },

        removeData: function( key ){
                return this.each(function(){
                        jQuery.removeData( this, key );
                });
        },

        domManip: function( args, table, reverse, callback ) {
                var clone = this.length > 1, elems;

                return this.each(function(){
                        if ( !elems ) {
                                elems = jQuery.clean( args, this.ownerDocument );

                                if ( reverse )
                                        elems.reverse();
                        }

                        var obj = this;

                        if ( table && jQuery.nodeName( this, "table" ) && jQuery.nodeName( elems[0], "tr" ) )
                                obj = this.getElementsByTagName("tbody")[0] || this.appendChild( this.ownerDocument.createElement("tbody") );

                        var scripts = jQuery( [] );

                        jQuery.each(elems, function(){
                                var elem = clone ?
                                        jQuery( this ).clone( true )[0] :
                                        this;

                                // execute all scripts after the elements have been injected
                                if ( jQuery.nodeName( elem, "script" ) )
                                        scripts = scripts.add( elem );
                                else {
                                        // Remove any inner scripts for later evaluation
                                        if ( elem.nodeType == 1 )
                                                scripts = scripts.add( jQuery( "script", elem ).remove() );

                                        // Inject the elements into the document
                                        callback.call( obj, elem );
                                }
                        });

                        scripts.each( evalScript );
                });
        }
};

// Give the init function the jQuery prototype for later instantiation
jQuery.fn.init.prototype = jQuery.fn;

function evalScript( i, elem ) {
        if ( elem.src )
                jQuery.ajax({
                        url: elem.src,
                        async: false,
                        dataType: "script"
                });

        else
                jQuery.globalEval( elem.text || elem.textContent || elem.innerHTML || "" );

        if ( elem.parentNode )
                elem.parentNode.removeChild( elem );
}

function now(){
        return +new Date;
}

jQuery.extend = jQuery.fn.extend = function() {
        // copy reference to target object
        var target = arguments[0] || {}, i = 1, length = arguments.length, deep = false, options;

        // Handle a deep copy situation
        if ( target.constructor == Boolean ) {
                deep = target;
                target = arguments[1] || {};
                // skip the boolean and the target
                i = 2;
        }

        // Handle case when target is a string or something (possible in deep copy)
        if ( typeof target != "object" && typeof target != "function" )
                target = {};

        // extend jQuery itself if only one argument is passed
        if ( length == i ) {
                target = this;
                --i;
        }

        for ( ; i < length; i++ )
                // Only deal with non-null/undefined values
                if ( (options = arguments[ i ]) != null )
                        // Extend the base object
                        for ( var name in options ) {
                                var src = target[ name ], copy = options[ name ];

                                // Prevent never-ending loop
                                if ( target === copy )
                                        continue;

                                // Recurse if we're merging object values
                                if ( deep && copy && typeof copy == "object" && !copy.nodeType )
                                        target[ name ] = jQuery.extend( deep, 
                                                // Never move original objects, clone them
                                                src || ( copy.length != null ? [ ] : { } )
                                        , copy );

                                // Don't bring in undefined values
                                else if ( copy !== undefined )
                                        target[ name ] = copy;

                        }

        // Return the modified object
        return target;
};

var expando = "jQuery" + now(), uuid = 0, windowData = {},
        // exclude the following css properties to add px
        exclude = /z-?index|font-?weight|opacity|zoom|line-?height/i,
        // cache defaultView
        defaultView = document.defaultView || {};

jQuery.extend({
        noConflict: function( deep ) {
                window.$ = _$;

                if ( deep )
                        window.jQuery = _jQuery;

                return jQuery;
        },

        // See test/unit/core.js for details concerning this function.
        isFunction: function( fn ) {
                return !!fn && typeof fn != "string" && !fn.nodeName &&
                        fn.constructor != Array && /^[\s[]?function/.test( fn + "" );
        },

        // check if an element is in a (or is an) XML document
        isXMLDoc: function( elem ) {
                return elem.documentElement && !elem.body ||
                        elem.tagName && elem.ownerDocument && !elem.ownerDocument.body;
        },

        // Evalulates a script in a global context
        globalEval: function( data ) {
                data = jQuery.trim( data );

                if ( data ) {
                        // Inspired by code by Andrea Giammarchi
                        // http://webreflection.blogspot.com/2007/08/global-scope-evaluation-and-dom.html
                        var head = document.getElementsByTagName("head")[0] || document.documentElement,
                                script = document.createElement("script");

                        script.type = "text/javascript";
                        if ( jQuery.browser.msie )
                                script.text = data;
                        else
                                script.appendChild( document.createTextNode( data ) );

                        // Use insertBefore instead of appendChild  to circumvent an IE6 bug.
                        // This arises when a base node is used (#2709).
                        head.insertBefore( script, head.firstChild );
                        head.removeChild( script );
                }
        },

        nodeName: function( elem, name ) {
                return elem.nodeName && elem.nodeName.toUpperCase() == name.toUpperCase();
        },

        cache: {},

        data: function( elem, name, data ) {
                elem = elem == window ?
                        windowData :
                        elem;

                var id = elem[ expando ];

                // Compute a unique ID for the element
                if ( !id )
                        id = elem[ expando ] = ++uuid;

                // Only generate the data cache if we're
                // trying to access or manipulate it
                if ( name && !jQuery.cache[ id ] )
                        jQuery.cache[ id ] = {};

                // Prevent overriding the named cache with undefined values
                if ( data !== undefined )
                        jQuery.cache[ id ][ name ] = data;

                // Return the named cache data, or the ID for the element
                return name ?
                        jQuery.cache[ id ][ name ] :
                        id;
        },

        removeData: function( elem, name ) {
                elem = elem == window ?
                        windowData :
                        elem;

                var id = elem[ expando ];

                // If we want to remove a specific section of the element's data
                if ( name ) {
                        if ( jQuery.cache[ id ] ) {
                                // Remove the section of cache data
                                delete jQuery.cache[ id ][ name ];

                                // If we've removed all the data, remove the element's cache
                                name = "";

                                for ( name in jQuery.cache[ id ] )
                                        break;

                                if ( !name )
                                        jQuery.removeData( elem );
                        }

                // Otherwise, we want to remove all of the element's data
                } else {
                        // Clean up the element expando
                        try {
                                delete elem[ expando ];
                        } catch(e){
                                // IE has trouble directly removing the expando
                                // but it's ok with using removeAttribute
                                if ( elem.removeAttribute )
                                        elem.removeAttribute( expando );
                        }

                        // Completely remove the data cache
                        delete jQuery.cache[ id ];
                }
        },

        // args is for internal usage only
        each: function( object, callback, args ) {
                var name, i = 0, length = object.length;

                if ( args ) {
                        if ( length == undefined ) {
                                for ( name in object )
                                        if ( callback.apply( object[ name ], args ) === false )
                                                break;
                        } else
                                for ( ; i < length; )
                                        if ( callback.apply( object[ i++ ], args ) === false )
                                                break;

                // A special, fast, case for the most common use of each
                } else {
                        if ( length == undefined ) {
                                for ( name in object )
                                        if ( callback.call( object[ name ], name, object[ name ] ) === false )
                                                break;
                        } else
                                for ( var value = object[0];
                                        i < length && callback.call( value, i, value ) !== false; value = object[++i] ){}
                }

                return object;
        },

        prop: function( elem, value, type, i, name ) {
                // Handle executable functions
                if ( jQuery.isFunction( value ) )
                        value = value.call( elem, i );

                // Handle passing in a number to a CSS property
                return value && value.constructor == Number && type == "curCSS" && !exclude.test( name ) ?
                        value + "px" :
                        value;
        },

        className: {
                // internal only, use addClass("class")
                add: function( elem, classNames ) {
                        jQuery.each((classNames || "").split(/\s+/), function(i, className){
                                if ( elem.nodeType == 1 && !jQuery.className.has( elem.className, className ) )
                                        elem.className += (elem.className ? " " : "") + className;
                        });
                },

                // internal only, use removeClass("class")
                remove: function( elem, classNames ) {
                        if (elem.nodeType == 1)
                                elem.className = classNames != undefined ?
                                        jQuery.grep(elem.className.split(/\s+/), function(className){
                                                return !jQuery.className.has( classNames, className );
                                        }).join(" ") :
                                        "";
                },

                // internal only, use hasClass("class")
                has: function( elem, className ) {
                        return jQuery.inArray( className, (elem.className || elem).toString().split(/\s+/) ) > -1;
                }
        },

        // A method for quickly swapping in/out CSS properties to get correct calculations
        swap: function( elem, options, callback ) {
                var old = {};
                // Remember the old values, and insert the new ones
                for ( var name in options ) {
                        old[ name ] = elem.style[ name ];
                        elem.style[ name ] = options[ name ];
                }

                callback.call( elem );

                // Revert the old values
                for ( var name in options )
                        elem.style[ name ] = old[ name ];
        },

        css: function( elem, name, force ) {
                if ( name == "width" || name == "height" ) {
                        var val, props = { position: "absolute", visibility: "hidden", display:"block" }, which = name == "width" ? [ "Left", "Right" ] : [ "Top", "Bottom" ];

                        function getWH() {
                                val = name == "width" ? elem.offsetWidth : elem.offsetHeight;
                                var padding = 0, border = 0;
                                jQuery.each( which, function() {
                                        padding += parseFloat(jQuery.curCSS( elem, "padding" + this, true)) || 0;
                                        border += parseFloat(jQuery.curCSS( elem, "border" + this + "Width", true)) || 0;
                                });
                                val -= Math.round(padding + border);
                        }

                        if ( jQuery(elem).is(":visible") )
                                getWH();
                        else
                                jQuery.swap( elem, props, getWH );

                        return Math.max(0, val);
                }

                return jQuery.curCSS( elem, name, force );
        },

        curCSS: function( elem, name, force ) {
                var ret, style = elem.style;

                // A helper method for determining if an element's values are broken
                function color( elem ) {
                        if ( !jQuery.browser.safari )
                                return false;

                        // defaultView is cached
                        var ret = defaultView.getComputedStyle( elem, null );
                        return !ret || ret.getPropertyValue("color") == "";
                }

                // We need to handle opacity special in IE
                if ( name == "opacity" && jQuery.browser.msie ) {
                        ret = jQuery.attr( style, "opacity" );

                        return ret == "" ?
                                "1" :
                                ret;
                }
                // Opera sometimes will give the wrong display answer, this fixes it, see #2037
                if ( jQuery.browser.opera && name == "display" ) {
                        var save = style.outline;
                        style.outline = "0 solid black";
                        style.outline = save;
                }

                // Make sure we're using the right name for getting the float value
                if ( name.match( /float/i ) )
                        name = styleFloat;

                if ( !force && style && style[ name ] )
                        ret = style[ name ];

                else if ( defaultView.getComputedStyle ) {

                        // Only "float" is needed here
                        if ( name.match( /float/i ) )
                                name = "float";

                        name = name.replace( /([A-Z])/g, "-$1" ).toLowerCase();

                        var computedStyle = defaultView.getComputedStyle( elem, null );

                        if ( computedStyle && !color( elem ) )
                                ret = computedStyle.getPropertyValue( name );

                        // If the element isn't reporting its values properly in Safari
                        // then some display: none elements are involved
                        else {
                                var swap = [], stack = [], a = elem, i = 0;

                                // Locate all of the parent display: none elements
                                for ( ; a && color(a); a = a.parentNode )
                                        stack.unshift(a);

                                // Go through and make them visible, but in reverse
                                // (It would be better if we knew the exact display type that they had)
                                for ( ; i < stack.length; i++ )
                                        if ( color( stack[ i ] ) ) {
                                                swap[ i ] = stack[ i ].style.display;
                                                stack[ i ].style.display = "block";
                                        }

                                // Since we flip the display style, we have to handle that
                                // one special, otherwise get the value
                                ret = name == "display" && swap[ stack.length - 1 ] != null ?
                                        "none" :
                                        ( computedStyle && computedStyle.getPropertyValue( name ) ) || "";

                                // Finally, revert the display styles back
                                for ( i = 0; i < swap.length; i++ )
                                        if ( swap[ i ] != null )
                                                stack[ i ].style.display = swap[ i ];
                        }

                        // We should always get a number back from opacity
                        if ( name == "opacity" && ret == "" )
                                ret = "1";

                } else if ( elem.currentStyle ) {
                        var camelCase = name.replace(/\-(\w)/g, function(all, letter){
                                return letter.toUpperCase();
                        });

                        ret = elem.currentStyle[ name ] || elem.currentStyle[ camelCase ];

                        // From the awesome hack by Dean Edwards
                        // http://erik.eae.net/archives/2007/07/27/18.54.15/#comment-102291

                        // If we're not dealing with a regular pixel number
                        // but a number that has a weird ending, we need to convert it to pixels
                        if ( !/^\d+(px)?$/i.test( ret ) && /^\d/.test( ret ) ) {
                                // Remember the original values
                                var left = style.left, rsLeft = elem.runtimeStyle.left;

                                // Put in the new values to get a computed value out
                                elem.runtimeStyle.left = elem.currentStyle.left;
                                style.left = ret || 0;
                                ret = style.pixelLeft + "px";

                                // Revert the changed values
                                style.left = left;
                                elem.runtimeStyle.left = rsLeft;
                        }
                }

                return ret;
        },

        clean: function( elems, context ) {
                var ret = [];
                context = context || document;
                // !context.createElement fails in IE with an error but returns typeof 'object'
                if (typeof context.createElement == 'undefined')
                        context = context.ownerDocument || context[0] && context[0].ownerDocument || document;

                jQuery.each(elems, function(i, elem){
                        if ( !elem )
                                return;

                        if ( elem.constructor == Number )
                                elem += '';

                        // Convert html string into DOM nodes
                        if ( typeof elem == "string" ) {
                                // Fix "XHTML"-style tags in all browsers
                                elem = elem.replace(/(<(\w+)[^>]*?)\/>/g, function(all, front, tag){
                                        return tag.match(/^(abbr|br|col|img|input|link|meta|param|hr|area|embed)$/i) ?
                                                all :
                                                front + "></" + tag + ">";
                                });

                                // Trim whitespace, otherwise indexOf won't work as expected
                                var tags = jQuery.trim( elem ).toLowerCase(), div = context.createElement("div");

                                var wrap =
                                        // option or optgroup
                                        !tags.indexOf("<opt") &&
                                        [ 1, "<select multiple='multiple'>", "</select>" ] ||

                                        !tags.indexOf("<leg") &&
                                        [ 1, "<fieldset>", "</fieldset>" ] ||

                                        tags.match(/^<(thead|tbody|tfoot|colg|cap)/) &&
                                        [ 1, "<table>", "</table>" ] ||

                                        !tags.indexOf("<tr") &&
                                        [ 2, "<table><tbody>", "</tbody></table>" ] ||

                                        // <thead> matched above
                                        (!tags.indexOf("<td") || !tags.indexOf("<th")) &&
                                        [ 3, "<table><tbody><tr>", "</tr></tbody></table>" ] ||

                                        !tags.indexOf("<col") &&
                                        [ 2, "<table><tbody></tbody><colgroup>", "</colgroup></table>" ] ||

                                        // IE can't serialize <link> and <script> tags normally
                                        jQuery.browser.msie &&
                                        [ 1, "div<div>", "</div>" ] ||

                                        [ 0, "", "" ];

                                // Go to html and back, then peel off extra wrappers
                                div.innerHTML = wrap[1] + elem + wrap[2];

                                // Move to the right depth
                                while ( wrap[0]-- )
                                        div = div.lastChild;

                                // Remove IE's autoinserted <tbody> from table fragments
                                if ( jQuery.browser.msie ) {

                                        // String was a <table>, *may* have spurious <tbody>
                                        var tbody = !tags.indexOf("<table") && tags.indexOf("<tbody") < 0 ?
                                                div.firstChild && div.firstChild.childNodes :

                                                // String was a bare <thead> or <tfoot>
                                                wrap[1] == "<table>" && tags.indexOf("<tbody") < 0 ?
                                                        div.childNodes :
                                                        [];

                                        for ( var j = tbody.length - 1; j >= 0 ; --j )
                                                if ( jQuery.nodeName( tbody[ j ], "tbody" ) && !tbody[ j ].childNodes.length )
                                                        tbody[ j ].parentNode.removeChild( tbody[ j ] );

                                        // IE completely kills leading whitespace when innerHTML is used
                                        if ( /^\s/.test( elem ) )
                                                div.insertBefore( context.createTextNode( elem.match(/^\s*/)[0] ), div.firstChild );

                                }

                                elem = jQuery.makeArray( div.childNodes );
                        }

                        if ( elem.length === 0 && (!jQuery.nodeName( elem, "form" ) && !jQuery.nodeName( elem, "select" )) )
                                return;

                        if ( elem[0] == undefined || jQuery.nodeName( elem, "form" ) || elem.options )
                                ret.push( elem );

                        else
                                ret = jQuery.merge( ret, elem );

                });

                return ret;
        },

        attr: function( elem, name, value ) {
                // don't set attributes on text and comment nodes
                if (!elem || elem.nodeType == 3 || elem.nodeType == 8)
                        return undefined;

                var notxml = !jQuery.isXMLDoc( elem ),
                        // Whether we are setting (or getting)
                        set = value !== undefined,
                        msie = jQuery.browser.msie;

                // Try to normalize/fix the name
                name = notxml && jQuery.props[ name ] || name;

                // Only do all the following if this is a node (faster for style)
                // IE elem.getAttribute passes even for style
                if ( elem.tagName ) {

                        // These attributes require special treatment
                        var special = /href|src|style/.test( name );

                        // Safari mis-reports the default selected property of a hidden option
                        // Accessing the parent's selectedIndex property fixes it
                        if ( name == "selected" && jQuery.browser.safari )
                                elem.parentNode.selectedIndex;

                        // If applicable, access the attribute via the DOM 0 way
                        if ( name in elem && notxml && !special ) {
                                if ( set ){
                                        // We can't allow the type property to be changed (since it causes problems in IE)
                                        if ( name == "type" && jQuery.nodeName( elem, "input" ) && elem.parentNode )
                                                throw "type property can't be changed";

                                        elem[ name ] = value;
                                }

                                // browsers index elements by id/name on forms, give priority to attributes.
                                if( jQuery.nodeName( elem, "form" ) && elem.getAttributeNode(name) )
                                        return elem.getAttributeNode( name ).nodeValue;

                                return elem[ name ];
                        }

                        if ( msie && notxml &&  name == "style" )
                                return jQuery.attr( elem.style, "cssText", value );

                        if ( set )
                                // convert the value to a string (all browsers do this but IE) see #1070
                                elem.setAttribute( name, "" + value );

                        var attr = msie && notxml && special
                                        // Some attributes require a special call on IE
                                        ? elem.getAttribute( name, 2 )
                                        : elem.getAttribute( name );

                        // Non-existent attributes return null, we normalize to undefined
                        return attr === null ? undefined : attr;
                }

                // elem is actually elem.style ... set the style

                // IE uses filters for opacity
                if ( msie && name == "opacity" ) {
                        if ( set ) {
                                // IE has trouble with opacity if it does not have layout
                                // Force it by setting the zoom level
                                elem.zoom = 1;

                                // Set the alpha filter to set the opacity
                                elem.filter = (elem.filter || "").replace( /alpha\([^)]*\)/, "" ) +
                                        (parseInt( value ) + '' == "NaN" ? "" : "alpha(opacity=" + value * 100 + ")");
                        }

                        return elem.filter && elem.filter.indexOf("opacity=") >= 0 ?
                                (parseFloat( elem.filter.match(/opacity=([^)]*)/)[1] ) / 100) + '':
                                "";
                }

                name = name.replace(/-([a-z])/ig, function(all, letter){
                        return letter.toUpperCase();
                });

                if ( set )
                        elem[ name ] = value;

                return elem[ name ];
        },

        trim: function( text ) {
                return (text || "").replace( /^\s+|\s+$/g, "" );
        },

        makeArray: function( array ) {
                var ret = [];

                if( array != null ){
                        var i = array.length;
                        //the window, strings and functions also have 'length'
                        if( i == null || array.split || array.setInterval || array.call )
                                ret[0] = array;
                        else
                                while( i )
                                        ret[--i] = array[i];
                }

                return ret;
        },

        inArray: function( elem, array ) {
                for ( var i = 0, length = array.length; i < length; i++ )
                // Use === because on IE, window == document
                        if ( array[ i ] === elem )
                                return i;

                return -1;
        },

        merge: function( first, second ) {
                // We have to loop this way because IE & Opera overwrite the length
                // expando of getElementsByTagName
                var i = 0, elem, pos = first.length;
                // Also, we need to make sure that the correct elements are being returned
                // (IE returns comment nodes in a '*' query)
                if ( jQuery.browser.msie ) {
                        while ( elem = second[ i++ ] )
                                if ( elem.nodeType != 8 )
                                        first[ pos++ ] = elem;

                } else
                        while ( elem = second[ i++ ] )
                                first[ pos++ ] = elem;

                return first;
        },

        unique: function( array ) {
                var ret = [], done = {};

                try {

                        for ( var i = 0, length = array.length; i < length; i++ ) {
                                var id = jQuery.data( array[ i ] );

                                if ( !done[ id ] ) {
                                        done[ id ] = true;
                                        ret.push( array[ i ] );
                                }
                        }

                } catch( e ) {
                        ret = array;
                }

                return ret;
        },

        grep: function( elems, callback, inv ) {
                var ret = [];

                // Go through the array, only saving the items
                // that pass the validator function
                for ( var i = 0, length = elems.length; i < length; i++ )
                        if ( !inv != !callback( elems[ i ], i ) )
                                ret.push( elems[ i ] );

                return ret;
        },

        map: function( elems, callback ) {
                var ret = [];

                // Go through the array, translating each of the items to their
                // new value (or values).
                for ( var i = 0, length = elems.length; i < length; i++ ) {
                        var value = callback( elems[ i ], i );

                        if ( value != null )
                                ret[ ret.length ] = value;
                }

                return ret.concat.apply( [], ret );
        }
});

var userAgent = navigator.userAgent.toLowerCase();

// Figure out what browser is being used
jQuery.browser = {
        version: (userAgent.match( /.+(?:rv|it|ra|ie)[\/: ]([\d.]+)/ ) || [])[1],
        safari: /webkit/.test( userAgent ),
        opera: /opera/.test( userAgent ),
        msie: /msie/.test( userAgent ) && !/opera/.test( userAgent ),
        mozilla: /mozilla/.test( userAgent ) && !/(compatible|webkit)/.test( userAgent )
};

var styleFloat = jQuery.browser.msie ?
        "styleFloat" :
        "cssFloat";

jQuery.extend({
        // Check to see if the W3C box model is being used
        boxModel: !jQuery.browser.msie || document.compatMode == "CSS1Compat",

        props: {
                "for": "htmlFor",
                "class": "className",
                "float": styleFloat,
                cssFloat: styleFloat,
                styleFloat: styleFloat,
                readonly: "readOnly",
                maxlength: "maxLength",
                cellspacing: "cellSpacing",
                rowspan: "rowSpan"
        }
});

jQuery.each({
        parent: function(elem){return elem.parentNode;},
        parents: function(elem){return jQuery.dir(elem,"parentNode");},
        next: function(elem){return jQuery.nth(elem,2,"nextSibling");},
        prev: function(elem){return jQuery.nth(elem,2,"previousSibling");},
        nextAll: function(elem){return jQuery.dir(elem,"nextSibling");},
        prevAll: function(elem){return jQuery.dir(elem,"previousSibling");},
        siblings: function(elem){return jQuery.sibling(elem.parentNode.firstChild,elem);},
        children: function(elem){return jQuery.sibling(elem.firstChild);},
        contents: function(elem){return jQuery.nodeName(elem,"iframe")?elem.contentDocument||elem.contentWindow.document:jQuery.makeArray(elem.childNodes);}
}, function(name, fn){
        jQuery.fn[ name ] = function( selector ) {
                var ret = jQuery.map( this, fn );

                if ( selector && typeof selector == "string" )
                        ret = jQuery.multiFilter( selector, ret );

                return this.pushStack( jQuery.unique( ret ) );
        };
});

jQuery.each({
        appendTo: "append",
        prependTo: "prepend",
        insertBefore: "before",
        insertAfter: "after",
        replaceAll: "replaceWith"
}, function(name, original){
        jQuery.fn[ name ] = function() {
                var args = arguments;

                return this.each(function(){
                        for ( var i = 0, length = args.length; i < length; i++ )
                                jQuery( args[ i ] )[ original ]( this );
                });
        };
});

jQuery.each({
        removeAttr: function( name ) {
                jQuery.attr( this, name, "" );
                if (this.nodeType == 1)
                        this.removeAttribute( name );
        },

        addClass: function( classNames ) {
                jQuery.className.add( this, classNames );
        },

        removeClass: function( classNames ) {
                jQuery.className.remove( this, classNames );
        },

        toggleClass: function( classNames ) {
                jQuery.className[ jQuery.className.has( this, classNames ) ? "remove" : "add" ]( this, classNames );
        },

        remove: function( selector ) {
                if ( !selector || jQuery.filter( selector, [ this ] ).r.length ) {
                        // Prevent memory leaks
                        jQuery( "*", this ).add(this).each(function(){
                                jQuery.event.remove(this);
                                jQuery.removeData(this);
                        });
                        if (this.parentNode)
                                this.parentNode.removeChild( this );
                }
        },

        empty: function() {
                // Remove element nodes and prevent memory leaks
                jQuery( ">*", this ).remove();

                // Remove any remaining nodes
                while ( this.firstChild )
                        this.removeChild( this.firstChild );
        }
}, function(name, fn){
        jQuery.fn[ name ] = function(){
                return this.each( fn, arguments );
        };
});

jQuery.each([ "Height", "Width" ], function(i, name){
        var type = name.toLowerCase();

        jQuery.fn[ type ] = function( size ) {
                // Get window width or height
                return this[0] == window ?
                        // Opera reports document.body.client[Width/Height] properly in both quirks and standards
                        jQuery.browser.opera && document.body[ "client" + name ] ||

                        // Safari reports inner[Width/Height] just fine (Mozilla and Opera include scroll bar widths)
                        jQuery.browser.safari && window[ "inner" + name ] ||

                        // Everyone else use document.documentElement or document.body depending on Quirks vs Standards mode
                        document.compatMode == "CSS1Compat" && document.documentElement[ "client" + name ] || document.body[ "client" + name ] :

                        // Get document width or height
                        this[0] == document ?
                                // Either scroll[Width/Height] or offset[Width/Height], whichever is greater
                                Math.max(
                                        Math.max(document.body["scroll" + name], document.documentElement["scroll" + name]),
                                        Math.max(document.body["offset" + name], document.documentElement["offset" + name])
                                ) :

                                // Get or set width or height on the element
                                size == undefined ?
                                        // Get width or height on the element
                                        (this.length ? jQuery.css( this[0], type ) : null) :

                                        // Set the width or height on the element (default to pixels if value is unitless)
                                        this.css( type, size.constructor == String ? size : size + "px" );
        };
});

// Helper function used by the dimensions and offset modules
function num(elem, prop) {
        return elem[0] && parseInt( jQuery.curCSS(elem[0], prop, true), 10 ) || 0;
}var chars = jQuery.browser.safari && parseInt(jQuery.browser.version) < 417 ?
                "(?:[\\w*_-]|\\\\.)" :
                "(?:[\\w\u0128-\uFFFF*_-]|\\\\.)",
        quickChild = new RegExp("^>\\s*(" + chars + "+)"),
        quickID = new RegExp("^(" + chars + "+)(#)(" + chars + "+)"),
        quickClass = new RegExp("^([#.]?)(" + chars + "*)");

jQuery.extend({
        expr: {
                "": function(a,i,m){return m[2]=="*"||jQuery.nodeName(a,m[2]);},
                "#": function(a,i,m){return a.getAttribute("id")==m[2];},
                ":": {
                        // Position Checks
                        lt: function(a,i,m){return i<m[3]-0;},
                        gt: function(a,i,m){return i>m[3]-0;},
                        nth: function(a,i,m){return m[3]-0==i;},
                        eq: function(a,i,m){return m[3]-0==i;},
                        first: function(a,i){return i==0;},
                        last: function(a,i,m,r){return i==r.length-1;},
                        even: function(a,i){return i%2==0;},
                        odd: function(a,i){return i%2;},

                        // Child Checks
                        "first-child": function(a){return a.parentNode.getElementsByTagName("*")[0]==a;},
                        "last-child": function(a){return jQuery.nth(a.parentNode.lastChild,1,"previousSibling")==a;},
                        "only-child": function(a){return !jQuery.nth(a.parentNode.lastChild,2,"previousSibling");},

                        // Parent Checks
                        parent: function(a){return a.firstChild;},
                        empty: function(a){return !a.firstChild;},

                        // Text Check
                        contains: function(a,i,m){return (a.textContent||a.innerText||jQuery(a).text()||"").indexOf(m[3])>=0;},

                        // Visibility
                        visible: function(a){return "hidden"!=a.type&&jQuery.css(a,"display")!="none"&&jQuery.css(a,"visibility")!="hidden";},
                        hidden: function(a){return "hidden"==a.type||jQuery.css(a,"display")=="none"||jQuery.css(a,"visibility")=="hidden";},

                        // Form attributes
                        enabled: function(a){return !a.disabled;},
                        disabled: function(a){return a.disabled;},
                        checked: function(a){return a.checked;},
                        selected: function(a){return a.selected||jQuery.attr(a,"selected");},

                        // Form elements
                        text: function(a){return "text"==a.type;},
                        radio: function(a){return "radio"==a.type;},
                        checkbox: function(a){return "checkbox"==a.type;},
                        file: function(a){return "file"==a.type;},
                        password: function(a){return "password"==a.type;},
                        submit: function(a){return "submit"==a.type;},
                        image: function(a){return "image"==a.type;},
                        reset: function(a){return "reset"==a.type;},
                        button: function(a){return "button"==a.type||jQuery.nodeName(a,"button");},
                        input: function(a){return /input|select|textarea|button/i.test(a.nodeName);},

                        // :has()
                        has: function(a,i,m){return jQuery.find(m[3],a).length;},

                        // :header
                        header: function(a){return /h\d/i.test(a.nodeName);},

                        // :animated
                        animated: function(a){return jQuery.grep(jQuery.timers,function(fn){return a==fn.elem;}).length;}
                }
        },

        // The regular expressions that power the parsing engine
        parse: [
                // Match: [@value='test'], [@foo]
                /^(\[) *@?([\w-]+) *([!*$^~=]*) *('?"?)(.*?)\4 *\]/,

                // Match: :contains('foo')
                /^(:)([\w-]+)\("?'?(.*?(\(.*?\))?[^(]*?)"?'?\)/,

                // Match: :even, :last-child, #id, .class
                new RegExp("^([:.#]*)(" + chars + "+)")
        ],

        multiFilter: function( expr, elems, not ) {
                var old, cur = [];

                while ( expr && expr != old ) {
                        old = expr;
                        var f = jQuery.filter( expr, elems, not );
                        expr = f.t.replace(/^\s*,\s*/, "" );
                        cur = not ? elems = f.r : jQuery.merge( cur, f.r );
                }

                return cur;
        },

        find: function( t, context ) {
                // Quickly handle non-string expressions
                if ( typeof t != "string" )
                        return [ t ];

                // check to make sure context is a DOM element or a document
                if ( context && context.nodeType != 1 && context.nodeType != 9)
                        return [ ];

                // Set the correct context (if none is provided)
                context = context || document;

                // Initialize the search
                var ret = [context], done = [], last, nodeName;

                // Continue while a selector expression exists, and while
                // we're no longer looping upon ourselves
                while ( t && last != t ) {
                        var r = [];
                        last = t;

                        t = jQuery.trim(t);

                        var foundToken = false,

                        // An attempt at speeding up child selectors that
                        // point to a specific element tag
                                re = quickChild,

                                m = re.exec(t);

                        if ( m ) {
                                nodeName = m[1].toUpperCase();

                                // Perform our own iteration and filter
                                for ( var i = 0; ret[i]; i++ )
                                        for ( var c = ret[i].firstChild; c; c = c.nextSibling )
                                                if ( c.nodeType == 1 && (nodeName == "*" || c.nodeName.toUpperCase() == nodeName) )
                                                        r.push( c );

                                ret = r;
                                t = t.replace( re, "" );
                                if ( t.indexOf(" ") == 0 ) continue;
                                foundToken = true;
                        } else {
                                re = /^([>+~])\s*(\w*)/i;

                                if ( (m = re.exec(t)) != null ) {
                                        r = [];

                                        var merge = {};
                                        nodeName = m[2].toUpperCase();
                                        m = m[1];

                                        for ( var j = 0, rl = ret.length; j < rl; j++ ) {
                                                var n = m == "~" || m == "+" ? ret[j].nextSibling : ret[j].firstChild;
                                                for ( ; n; n = n.nextSibling )
                                                        if ( n.nodeType == 1 ) {
                                                                var id = jQuery.data(n);

                                                                if ( m == "~" && merge[id] ) break;

                                                                if (!nodeName || n.nodeName.toUpperCase() == nodeName ) {
                                                                        if ( m == "~" ) merge[id] = true;
                                                                        r.push( n );
                                                                }

                                                                if ( m == "+" ) break;
                                                        }
                                        }

                                        ret = r;

                                        // And remove the token
                                        t = jQuery.trim( t.replace( re, "" ) );
                                        foundToken = true;
                                }
                        }

                        // See if there's still an expression, and that we haven't already
                        // matched a token
                        if ( t && !foundToken ) {
                                // Handle multiple expressions
                                if ( !t.indexOf(",") ) {
                                        // Clean the result set
                                        if ( context == ret[0] ) ret.shift();

                                        // Merge the result sets
                                        done = jQuery.merge( done, ret );

                                        // Reset the context
                                        r = ret = [context];

                                        // Touch up the selector string
                                        t = " " + t.substr(1,t.length);

                                } else {
                                        // Optimize for the case nodeName#idName
                                        var re2 = quickID;
                                        var m = re2.exec(t);

                                        // Re-organize the results, so that they're consistent
                                        if ( m ) {
                                                m = [ 0, m[2], m[3], m[1] ];

                                        } else {
                                                // Otherwise, do a traditional filter check for
                                                // ID, class, and element selectors
                                                re2 = quickClass;
                                                m = re2.exec(t);
                                        }

                                        m[2] = m[2].replace(/\\/g, "");

                                        var elem = ret[ret.length-1];

                                        // Try to do a global search by ID, where we can
                                        if ( m[1] == "#" && elem && elem.getElementById && !jQuery.isXMLDoc(elem) ) {
                                                // Optimization for HTML document case
                                                var oid = elem.getElementById(m[2]);

                                                // Do a quick check for the existence of the actual ID attribute
                                                // to avoid selecting by the name attribute in IE
                                                // also check to insure id is a string to avoid selecting an element with the name of 'id' inside a form
                                                if ( (jQuery.browser.msie||jQuery.browser.opera) && oid && typeof oid.id == "string" && oid.id != m[2] )
                                                        oid = jQuery('[@id="'+m[2]+'"]', elem)[0];

                                                // Do a quick check for node name (where applicable) so
                                                // that div#foo searches will be really fast
                                                ret = r = oid && (!m[3] || jQuery.nodeName(oid, m[3])) ? [oid] : [];
                                        } else {
                                                // We need to find all descendant elements
                                                for ( var i = 0; ret[i]; i++ ) {
                                                        // Grab the tag name being searched for
                                                        var tag = m[1] == "#" && m[3] ? m[3] : m[1] != "" || m[0] == "" ? "*" : m[2];

                                                        // Handle IE7 being really dumb about <object>s
                                                        if ( tag == "*" && ret[i].nodeName.toLowerCase() == "object" )
                                                                tag = "param";

                                                        r = jQuery.merge( r, ret[i].getElementsByTagName( tag ));
                                                }

                                                // It's faster to filter by class and be done with it
                                                if ( m[1] == "." )
                                                        r = jQuery.classFilter( r, m[2] );

                                                // Same with ID filtering
                                                if ( m[1] == "#" ) {
                                                        var tmp = [];

                                                        // Try to find the element with the ID
                                                        for ( var i = 0; r[i]; i++ )
                                                                if ( r[i].getAttribute("id") == m[2] ) {
                                                                        tmp = [ r[i] ];
                                                                        break;
                                                                }

                                                        r = tmp;
                                                }

                                                ret = r;
                                        }

                                        t = t.replace( re2, "" );
                                }

                        }

                        // If a selector string still exists
                        if ( t ) {
                                // Attempt to filter it
                                var val = jQuery.filter(t,r);
                                ret = r = val.r;
                                t = jQuery.trim(val.t);
                        }
                }

                // An error occurred with the selector;
                // just return an empty set instead
                if ( t )
                        ret = [];

                // Remove the root context
                if ( ret && context == ret[0] )
                        ret.shift();

                // And combine the results
                done = jQuery.merge( done, ret );

                return done;
        },

        classFilter: function(r,m,not){
                m = " " + m + " ";
                var tmp = [];
                for ( var i = 0; r[i]; i++ ) {
                        var pass = (" " + r[i].className + " ").indexOf( m ) >= 0;
                        if ( !not && pass || not && !pass )
                                tmp.push( r[i] );
                }
                return tmp;
        },

        filter: function(t,r,not) {
                var last;

                // Look for common filter expressions
                while ( t && t != last ) {
                        last = t;

                        var p = jQuery.parse, m;

                        for ( var i = 0; p[i]; i++ ) {
                                m = p[i].exec( t );

                                if ( m ) {
                                        // Remove what we just matched
                                        t = t.substring( m[0].length );

                                        m[2] = m[2].replace(/\\/g, "");
                                        break;
                                }
                        }

                        if ( !m )
                                break;

                        // :not() is a special case that can be optimized by
                        // keeping it out of the expression list
                        if ( m[1] == ":" && m[2] == "not" )
                                // optimize if only one selector found (most common case)
                                r = isSimple.test( m[3] ) ?
                                        jQuery.filter(m[3], r, true).r :
                                        jQuery( r ).not( m[3] );

                        // We can get a big speed boost by filtering by class here
                        else if ( m[1] == "." )
                                r = jQuery.classFilter(r, m[2], not);

                        else if ( m[1] == "[" ) {
                                var tmp = [], type = m[3];

                                for ( var i = 0, rl = r.length; i < rl; i++ ) {
                                        var a = r[i], z = a[ jQuery.props[m[2]] || m[2] ];

                                        if ( z == null || /href|src|selected/.test(m[2]) )
                                                z = jQuery.attr(a,m[2]) || '';

                                        if ( (type == "" && !!z ||
                                                 type == "=" && z == m[5] ||
                                                 type == "!=" && z != m[5] ||
                                                 type == "^=" && z && !z.indexOf(m[5]) ||
                                                 type == "$=" && z.substr(z.length - m[5].length) == m[5] ||
                                                 (type == "*=" || type == "~=") && z.indexOf(m[5]) >= 0) ^ not )
                                                        tmp.push( a );
                                }

                                r = tmp;

                        // We can get a speed boost by handling nth-child here
                        } else if ( m[1] == ":" && m[2] == "nth-child" ) {
                                var merge = {}, tmp = [],
                                        // parse equations like 'even', 'odd', '5', '2n', '3n+2', '4n-1', '-n+6'
                                        test = /(-?)(\d*)n((?:\+|-)?\d*)/.exec(
                                                m[3] == "even" && "2n" || m[3] == "odd" && "2n+1" ||
                                                !/\D/.test(m[3]) && "0n+" + m[3] || m[3]),
                                        // calculate the numbers (first)n+(last) including if they are negative
                                        first = (test[1] + (test[2] || 1)) - 0, last = test[3] - 0;

                                // loop through all the elements left in the jQuery object
                                for ( var i = 0, rl = r.length; i < rl; i++ ) {
                                        var node = r[i], parentNode = node.parentNode, id = jQuery.data(parentNode);

                                        if ( !merge[id] ) {
                                                var c = 1;

                                                for ( var n = parentNode.firstChild; n; n = n.nextSibling )
                                                        if ( n.nodeType == 1 )
                                                                n.nodeIndex = c++;

                                                merge[id] = true;
                                        }

                                        var add = false;

                                        if ( first == 0 ) {
                                                if ( node.nodeIndex == last )
                                                        add = true;
                                        } else if ( (node.nodeIndex - last) % first == 0 && (node.nodeIndex - last) / first >= 0 )
                                                add = true;

                                        if ( add ^ not )
                                                tmp.push( node );
                                }

                                r = tmp;

                        // Otherwise, find the expression to execute
                        } else {
                                var fn = jQuery.expr[ m[1] ];
                                if ( typeof fn == "object" )
                                        fn = fn[ m[2] ];

                                if ( typeof fn == "string" )
                                        fn = eval("false||function(a,i){return " + fn + ";}");

                                // Execute it against the current filter
                                r = jQuery.grep( r, function(elem, i){
                                        return fn(elem, i, m, r);
                                }, not );
                        }
                }

                // Return an array of filtered elements (r)
                // and the modified expression string (t)
                return { r: r, t: t };
        },

        dir: function( elem, dir ){
                var matched = [],
                        cur = elem[dir];
                while ( cur && cur != document ) {
                        if ( cur.nodeType == 1 )
                                matched.push( cur );
                        cur = cur[dir];
                }
                return matched;
        },

        nth: function(cur,result,dir,elem){
                result = result || 1;
                var num = 0;

                for ( ; cur; cur = cur[dir] )
                        if ( cur.nodeType == 1 && ++num == result )
                                break;

                return cur;
        },

        sibling: function( n, elem ) {
                var r = [];

                for ( ; n; n = n.nextSibling ) {
                        if ( n.nodeType == 1 && n != elem )
                                r.push( n );
                }

                return r;
        }
});
/*
 * A number of helper functions used for managing events.
 * Many of the ideas behind this code orignated from
 * Dean Edwards' addEvent library.
 */
jQuery.event = {

        // Bind an event to an element
        // Original by Dean Edwards
        add: function(elem, types, handler, data) {
                if ( elem.nodeType == 3 || elem.nodeType == 8 )
                        return;

                // For whatever reason, IE has trouble passing the window object
                // around, causing it to be cloned in the process
                if ( jQuery.browser.msie && elem.setInterval )
                        elem = window;

                // Make sure that the function being executed has a unique ID
                if ( !handler.guid )
                        handler.guid = this.guid++;

                // if data is passed, bind to handler
                if( data != undefined ) {
                        // Create temporary function pointer to original handler
                        var fn = handler;

                        // Create unique handler function, wrapped around original handler
                        handler = this.proxy( fn, function() {
                                // Pass arguments and context to original handler
                                return fn.apply(this, arguments);
                        });

                        // Store data in unique handler
                        handler.data = data;
                }

                // Init the element's event structure
                var events = jQuery.data(elem, "events") || jQuery.data(elem, "events", {}),
                        handle = jQuery.data(elem, "handle") || jQuery.data(elem, "handle", function(){
                                // Handle the second event of a trigger and when
                                // an event is called after a page has unloaded
                                if ( typeof jQuery != "undefined" && !jQuery.event.triggered )
                                        return jQuery.event.handle.apply(arguments.callee.elem, arguments);
                        });
                // Add elem as a property of the handle function
                // This is to prevent a memory leak with non-native
                // event in IE.
                handle.elem = elem;

                // Handle multiple events separated by a space
                // jQuery(...).bind("mouseover mouseout", fn);
                jQuery.each(types.split(/\s+/), function(index, type) {
                        // Namespaced event handlers
                        var parts = type.split(".");
                        type = parts[0];
                        handler.type = parts[1];

                        // Get the current list of functions bound to this event
                        var handlers = events[type];

                        // Init the event handler queue
                        if (!handlers) {
                                handlers = events[type] = {};

                                // Check for a special event handler
                                // Only use addEventListener/attachEvent if the special
                                // events handler returns false
                                if ( !jQuery.event.special[type] || jQuery.event.special[type].setup.call(elem) === false ) {
                                        // Bind the global event handler to the element
                                        if (elem.addEventListener)
                                                elem.addEventListener(type, handle, false);
                                        else if (elem.attachEvent)
                                                elem.attachEvent("on" + type, handle);
                                }
                        }

                        // Add the function to the element's handler list
                        handlers[handler.guid] = handler;

                        // Keep track of which events have been used, for global triggering
                        jQuery.event.global[type] = true;
                });

                // Nullify elem to prevent memory leaks in IE
                elem = null;
        },

        guid: 1,
        global: {},

        // Detach an event or set of events from an element
        remove: function(elem, types, handler) {
                // don't do events on text and comment nodes
                if ( elem.nodeType == 3 || elem.nodeType == 8 )
                        return;

                var events = jQuery.data(elem, "events"), ret, index;

                if ( events ) {
                        // Unbind all events for the element
                        if ( types == undefined || (typeof types == "string" && types.charAt(0) == ".") )
                                for ( var type in events )
                                        this.remove( elem, type + (types || "") );
                        else {
                                // types is actually an event object here
                                if ( types.type ) {
                                        handler = types.handler;
                                        types = types.type;
                                }

                                // Handle multiple events seperated by a space
                                // jQuery(...).unbind("mouseover mouseout", fn);
                                jQuery.each(types.split(/\s+/), function(index, type){
                                        // Namespaced event handlers
                                        var parts = type.split(".");
                                        type = parts[0];

                                        if ( events[type] ) {
                                                // remove the given handler for the given type
                                                if ( handler )
                                                        delete events[type][handler.guid];

                                                // remove all handlers for the given type
                                                else
                                                        for ( handler in events[type] )
                                                                // Handle the removal of namespaced events
                                                                if ( !parts[1] || events[type][handler].type == parts[1] )
                                                                        delete events[type][handler];

                                                // remove generic event handler if no more handlers exist
                                                for ( ret in events[type] ) break;
                                                if ( !ret ) {
                                                        if ( !jQuery.event.special[type] || jQuery.event.special[type].teardown.call(elem) === false ) {
                                                                if (elem.removeEventListener)
                                                                        elem.removeEventListener(type, jQuery.data(elem, "handle"), false);
                                                                else if (elem.detachEvent)
                                                                        elem.detachEvent("on" + type, jQuery.data(elem, "handle"));
                                                        }
                                                        ret = null;
                                                        delete events[type];
                                                }
                                        }
                                });
                        }

                        // Remove the expando if it's no longer used
                        for ( ret in events ) break;
                        if ( !ret ) {
                                var handle = jQuery.data( elem, "handle" );
                                if ( handle ) handle.elem = null;
                                jQuery.removeData( elem, "events" );
                                jQuery.removeData( elem, "handle" );
                        }
                }
        },

        trigger: function(type, data, elem, donative, extra) {
                // Clone the incoming data, if any
                data = jQuery.makeArray(data);

                if ( type.indexOf("!") >= 0 ) {
                        type = type.slice(0, -1);
                        var exclusive = true;
                }

                // Handle a global trigger
                if ( !elem ) {
                        // Only trigger if we've ever bound an event for it
                        if ( this.global[type] )
                                jQuery("*").add([window, document]).trigger(type, data);

                // Handle triggering a single element
                } else {
                        // don't do events on text and comment nodes
                        if ( elem.nodeType == 3 || elem.nodeType == 8 )
                                return undefined;

                        var val, ret, fn = jQuery.isFunction( elem[ type ] || null ),
                                // Check to see if we need to provide a fake event, or not
                                event = !data[0] || !data[0].preventDefault;

                        // Pass along a fake event
                        if ( event ) {
                                data.unshift({
                                        type: type,
                                        target: elem,
                                        preventDefault: function(){},
                                        stopPropagation: function(){},
                                        timeStamp: now()
                                });
                                data[0][expando] = true; // no need to fix fake event
                        }

                        // Enforce the right trigger type
                        data[0].type = type;
                        if ( exclusive )
                                data[0].exclusive = true;

                        // Trigger the event, it is assumed that "handle" is a function
                        var handle = jQuery.data(elem, "handle");
                        if ( handle )
                                val = handle.apply( elem, data );

                        // Handle triggering native .onfoo handlers (and on links since we don't call .click() for links)
                        if ( (!fn || (jQuery.nodeName(elem, 'a') && type == "click")) && elem["on"+type] && elem["on"+type].apply( elem, data ) === false )
                                val = false;

                        // Extra functions don't get the custom event object
                        if ( event )
                                data.shift();

                        // Handle triggering of extra function
                        if ( extra && jQuery.isFunction( extra ) ) {
                                // call the extra function and tack the current return value on the end for possible inspection
                                ret = extra.apply( elem, val == null ? data : data.concat( val ) );
                                // if anything is returned, give it precedence and have it overwrite the previous value
                                if (ret !== undefined)
                                        val = ret;
                        }

                        // Trigger the native events (except for clicks on links)
                        if ( fn && donative !== false && val !== false && !(jQuery.nodeName(elem, 'a') && type == "click") ) {
                                this.triggered = true;
                                try {
                                        elem[ type ]();
                                // prevent IE from throwing an error for some hidden elements
                                } catch (e) {}
                        }

                        this.triggered = false;
                }

                return val;
        },

        handle: function(event) {
                // returned undefined or false
                var val, ret, namespace, all, handlers;

                event = arguments[0] = jQuery.event.fix( event || window.event );

                // Namespaced event handlers
                namespace = event.type.split(".");
                event.type = namespace[0];
                namespace = namespace[1];
                // Cache this now, all = true means, any handler
                all = !namespace && !event.exclusive;

                handlers = ( jQuery.data(this, "events") || {} )[event.type];

                for ( var j in handlers ) {
                        var handler = handlers[j];

                        // Filter the functions by class
                        if ( all || handler.type == namespace ) {
                                // Pass in a reference to the handler function itself
                                // So that we can later remove it
                                event.handler = handler;
                                event.data = handler.data;

                                ret = handler.apply( this, arguments );

                                if ( val !== false )
                                        val = ret;

                                if ( ret === false ) {
                                        event.preventDefault();
                                        event.stopPropagation();
                                }
                        }
                }

                return val;
        },

        props: "altKey attrChange attrName bubbles button cancelable charCode clientX clientY ctrlKey currentTarget data detail eventPhase fromElement handler keyCode metaKey newValue originalTarget pageX pageY prevValue relatedNode relatedTarget screenX screenY shiftKey srcElement target timeStamp toElement type view wheelDelta which".split(" "),

        fix: function(event) {
                if ( event[expando] == true )
                        return event;

                // store a copy of the original event object
                // and "clone" to set read-only properties
                var originalEvent = event;
                event = { originalEvent: originalEvent };

                for ( var i = this.props.length, prop; i; ){
                        prop = this.props[ --i ];
                        event[ prop ] = originalEvent[ prop ];
                }

                // Mark it as fixed
                event[expando] = true;

                // add preventDefault and stopPropagation since
                // they will not work on the clone
                event.preventDefault = function() {
                        // if preventDefault exists run it on the original event
                        if (originalEvent.preventDefault)
                                originalEvent.preventDefault();
                        // otherwise set the returnValue property of the original event to false (IE)
                        originalEvent.returnValue = false;
                };
                event.stopPropagation = function() {
                        // if stopPropagation exists run it on the original event
                        if (originalEvent.stopPropagation)
                                originalEvent.stopPropagation();
                        // otherwise set the cancelBubble property of the original event to true (IE)
                        originalEvent.cancelBubble = true;
                };

                // Fix timeStamp
                event.timeStamp = event.timeStamp || now();

                // Fix target property, if necessary
                if ( !event.target )
                        event.target = event.srcElement || document; // Fixes #1925 where srcElement might not be defined either

                // check if target is a textnode (safari)
                if ( event.target.nodeType == 3 )
                        event.target = event.target.parentNode;

                // Add relatedTarget, if necessary
                if ( !event.relatedTarget && event.fromElement )
                        event.relatedTarget = event.fromElement == event.target ? event.toElement : event.fromElement;

                // Calculate pageX/Y if missing and clientX/Y available
                if ( event.pageX == null && event.clientX != null ) {
                        var doc = document.documentElement, body = document.body;
                        event.pageX = event.clientX + (doc && doc.scrollLeft || body && body.scrollLeft || 0) - (doc.clientLeft || 0);
                        event.pageY = event.clientY + (doc && doc.scrollTop || body && body.scrollTop || 0) - (doc.clientTop || 0);
                }

                // Add which for key events
                if ( !event.which && ((event.charCode || event.charCode === 0) ? event.charCode : event.keyCode) )
                        event.which = event.charCode || event.keyCode;

                // Add metaKey to non-Mac browsers (use ctrl for PC's and Meta for Macs)
                if ( !event.metaKey && event.ctrlKey )
                        event.metaKey = event.ctrlKey;

                // Add which for click: 1 == left; 2 == middle; 3 == right
                // Note: button is not normalized, so don't use it
                if ( !event.which && event.button )
                        event.which = (event.button & 1 ? 1 : ( event.button & 2 ? 3 : ( event.button & 4 ? 2 : 0 ) ));

                return event;
        },

        proxy: function( fn, proxy ){
                // Set the guid of unique handler to the same of original handler, so it can be removed
                proxy.guid = fn.guid = fn.guid || proxy.guid || this.guid++;
                // So proxy can be declared as an argument
                return proxy;
        },

        special: {
                ready: {
                        setup: function() {
                                // Make sure the ready event is setup
                                bindReady();
                                return;
                        },

                        teardown: function() { return; }
                },

                mouseenter: {
                        setup: function() {
                                if ( jQuery.browser.msie ) return false;
                                jQuery(this).bind("mouseover", jQuery.event.special.mouseenter.handler);
                                return true;
                        },

                        teardown: function() {
                                if ( jQuery.browser.msie ) return false;
                                jQuery(this).unbind("mouseover", jQuery.event.special.mouseenter.handler);
                                return true;
                        },

                        handler: function(event) {
                                // If we actually just moused on to a sub-element, ignore it
                                if ( withinElement(event, this) ) return true;
                                // Execute the right handlers by setting the event type to mouseenter
                                event.type = "mouseenter";
                                return jQuery.event.handle.apply(this, arguments);
                        }
                },

                mouseleave: {
                        setup: function() {
                                if ( jQuery.browser.msie ) return false;
                                jQuery(this).bind("mouseout", jQuery.event.special.mouseleave.handler);
                                return true;
                        },

                        teardown: function() {
                                if ( jQuery.browser.msie ) return false;
                                jQuery(this).unbind("mouseout", jQuery.event.special.mouseleave.handler);
                                return true;
                        },

                        handler: function(event) {
                                // If we actually just moused on to a sub-element, ignore it
                                if ( withinElement(event, this) ) return true;
                                // Execute the right handlers by setting the event type to mouseleave
                                event.type = "mouseleave";
                                return jQuery.event.handle.apply(this, arguments);
                        }
                }
        }
};

jQuery.fn.extend({
        bind: function( type, data, fn ) {
                return type == "unload" ? this.one(type, data, fn) : this.each(function(){
                        jQuery.event.add( this, type, fn || data, fn && data );
                });
        },

        one: function( type, data, fn ) {
                var one = jQuery.event.proxy( fn || data, function(event) {
                        jQuery(this).unbind(event, one);
                        return (fn || data).apply( this, arguments );
                });
                return this.each(function(){
                        jQuery.event.add( this, type, one, fn && data);
                });
        },

        unbind: function( type, fn ) {
                return this.each(function(){
                        jQuery.event.remove( this, type, fn );
                });
        },

        trigger: function( type, data, fn ) {
                return this.each(function(){
                        jQuery.event.trigger( type, data, this, true, fn );
                });
        },

        triggerHandler: function( type, data, fn ) {
                return this[0] && jQuery.event.trigger( type, data, this[0], false, fn );
        },

        toggle: function( fn ) {
                // Save reference to arguments for access in closure
                var args = arguments, i = 1;

                // link all the functions, so any of them can unbind this click handler
                while( i < args.length )
                        jQuery.event.proxy( fn, args[i++] );

                return this.click( jQuery.event.proxy( fn, function(event) {
                        // Figure out which function to execute
                        this.lastToggle = ( this.lastToggle || 0 ) % i;

                        // Make sure that clicks stop
                        event.preventDefault();

                        // and execute the function
                        return args[ this.lastToggle++ ].apply( this, arguments ) || false;
                }));
        },

        hover: function(fnOver, fnOut) {
                return this.bind('mouseenter', fnOver).bind('mouseleave', fnOut);
        },

        ready: function(fn) {
                // Attach the listeners
                bindReady();

                // If the DOM is already ready
                if ( jQuery.isReady )
                        // Execute the function immediately
                        fn.call( document, jQuery );

                // Otherwise, remember the function for later
                else
                        // Add the function to the wait list
                        jQuery.readyList.push( function() { return fn.call(this, jQuery); } );

                return this;
        }
});

jQuery.extend({
        isReady: false,
        readyList: [],
        // Handle when the DOM is ready
        ready: function() {
                // Make sure that the DOM is not already loaded
                if ( !jQuery.isReady ) {
                        // Remember that the DOM is ready
                        jQuery.isReady = true;

                        // If there are functions bound, to execute
                        if ( jQuery.readyList ) {
                                // Execute all of them
                                jQuery.each( jQuery.readyList, function(){
                                        this.call( document );
                                });

                                // Reset the list of functions
                                jQuery.readyList = null;
                        }

                        // Trigger any bound ready events
                        jQuery(document).triggerHandler("ready");
                }
        }
});

var readyBound = false;

function bindReady(){
        if ( readyBound ) return;
        readyBound = true;

        // Mozilla, Opera (see further below for it) and webkit nightlies currently support this event
        if ( document.addEventListener && !jQuery.browser.opera)
                // Use the handy event callback
                document.addEventListener( "DOMContentLoaded", jQuery.ready, false );

        // If IE is used and is not in a frame
        // Continually check to see if the document is ready
        if ( jQuery.browser.msie && window == top ) (function(){
                if (jQuery.isReady) return;
                try {
                        // If IE is used, use the trick by Diego Perini
                        // http://javascript.nwbox.com/IEContentLoaded/
                        document.documentElement.doScroll("left");
                } catch( error ) {
                        setTimeout( arguments.callee, 0 );
                        return;
                }
                // and execute any waiting functions
                jQuery.ready();
        })();

        if ( jQuery.browser.opera )
                document.addEventListener( "DOMContentLoaded", function () {
                        if (jQuery.isReady) return;
                        for (var i = 0; i < document.styleSheets.length; i++)
                                if (document.styleSheets[i].disabled) {
                                        setTimeout( arguments.callee, 0 );
                                        return;
                                }
                        // and execute any waiting functions
                        jQuery.ready();
                }, false);

        if ( jQuery.browser.safari ) {
                var numStyles;
                (function(){
                        if (jQuery.isReady) return;
                        if ( document.readyState != "loaded" && document.readyState != "complete" ) {
                                setTimeout( arguments.callee, 0 );
                                return;
                        }
                        if ( numStyles === undefined )
                                numStyles = jQuery("style, link[rel=stylesheet]").length;
                        if ( document.styleSheets.length != numStyles ) {
                                setTimeout( arguments.callee, 0 );
                                return;
                        }
                        // and execute any waiting functions
                        jQuery.ready();
                })();
        }

        // A fallback to window.onload, that will always work
        jQuery.event.add( window, "load", jQuery.ready );
}

jQuery.each( ("blur,focus,load,resize,scroll,unload,click,dblclick," +
        "mousedown,mouseup,mousemove,mouseover,mouseout,change,select," +
        "submit,keydown,keypress,keyup,error").split(","), function(i, name){

        // Handle event binding
        jQuery.fn[name] = function(fn){
                return fn ? this.bind(name, fn) : this.trigger(name);
        };
});

// Checks if an event happened on an element within another element
// Used in jQuery.event.special.mouseenter and mouseleave handlers
var withinElement = function(event, elem) {
        // Check if mouse(over|out) are still within the same parent element
        var parent = event.relatedTarget;
        // Traverse up the tree
        while ( parent && parent != elem ) try { parent = parent.parentNode; } catch(error) { parent = elem; }
        // Return true if we actually just moused on to a sub-element
        return parent == elem;
};

// Prevent memory leaks in IE
// And prevent errors on refresh with events like mouseover in other browsers
// Window isn't included so as not to unbind existing unload events
jQuery(window).bind("unload", function() {
        jQuery("*").add(document).unbind();
});
jQuery.fn.extend({
        // Keep a copy of the old load
        _load: jQuery.fn.load,

        load: function( url, params, callback ) {
                if ( typeof url != 'string' )
                        return this._load( url );

                var off = url.indexOf(" ");
                if ( off >= 0 ) {
                        var selector = url.slice(off, url.length);
                        url = url.slice(0, off);
                }

                callback = callback || function(){};

                // Default to a GET request
                var type = "GET";

                // If the second parameter was provided
                if ( params )
                        // If it's a function
                        if ( jQuery.isFunction( params ) ) {
                                // We assume that it's the callback
                                callback = params;
                                params = null;

                        // Otherwise, build a param string
                        } else if( typeof params == 'object' ) {
                                params = jQuery.param( params );
                                type = "POST";
                        }

                var self = this;

                // Request the remote document
                jQuery.ajax({
                        url: url,
                        type: type,
                        dataType: "html",
                        data: params,
                        complete: function(res, status){
                                // If successful, inject the HTML into all the matched elements
                                if ( status == "success" || status == "notmodified" )
                                        // See if a selector was specified
                                        self.html( selector ?
                                                // Create a dummy div to hold the results
                                                jQuery("<div/>")
                                                        // inject the contents of the document in, removing the scripts
                                                        // to avoid any 'Permission Denied' errors in IE
                                                        .append(res.responseText.replace(/<script(.|\s)*?\/script>/g, ""))

                                                        // Locate the specified elements
                                                        .find(selector) :

                                                // If not, just inject the full result
                                                res.responseText );

                                self.each( callback, [res.responseText, status, res] );
                        }
                });
                return this;
        },

        serialize: function() {
                return jQuery.param(this.serializeArray());
        },
        serializeArray: function() {
                return this.map(function(){
                        return jQuery.nodeName(this, "form") ?
                                jQuery.makeArray(this.elements) : this;
                })
                .filter(function(){
                        return this.name && !this.disabled &&
                                (this.checked || /select|textarea/i.test(this.nodeName) ||
                                        /text|hidden|password/i.test(this.type));
                })
                .map(function(i, elem){
                        var val = jQuery(this).val();
                        return val == null ? null :
                                val.constructor == Array ?
                                        jQuery.map( val, function(val, i){
                                                return {name: elem.name, value: val};
                                        }) :
                                        {name: elem.name, value: val};
                }).get();
        }
});

// Attach a bunch of functions for handling common AJAX events
jQuery.each( "ajaxStart,ajaxStop,ajaxComplete,ajaxError,ajaxSuccess,ajaxSend".split(","), function(i,o){
        jQuery.fn[o] = function(f){
                return this.bind(o, f);
        };
});

var jsc = now();

jQuery.extend({
        get: function( url, data, callback, type ) {
                // shift arguments if data argument was ommited
                if ( jQuery.isFunction( data ) ) {
                        callback = data;
                        data = null;
                }

                return jQuery.ajax({
                        type: "GET",
                        url: url,
                        data: data,
                        success: callback,
                        dataType: type
                });
        },

        getScript: function( url, callback ) {
                return jQuery.get(url, null, callback, "script");
        },

        getJSON: function( url, data, callback ) {
                return jQuery.get(url, data, callback, "json");
        },

        post: function( url, data, callback, type ) {
                if ( jQuery.isFunction( data ) ) {
                        callback = data;
                        data = {};
                }

                return jQuery.ajax({
                        type: "POST",
                        url: url,
                        data: data,
                        success: callback,
                        dataType: type
                });
        },

        ajaxSetup: function( settings ) {
                jQuery.extend( jQuery.ajaxSettings, settings );
        },

        ajaxSettings: {
                url: location.href,
                global: true,
                type: "GET",
                timeout: 0,
                contentType: "application/x-www-form-urlencoded",
                processData: true,
                async: true,
                data: null,
                username: null,
                password: null,
                accepts: {
                        xml: "application/xml, text/xml",
                        html: "text/html",
                        script: "text/javascript, application/javascript",
                        json: "application/json, text/javascript",
                        text: "text/plain",
                        _default: "*/*"
                }
        },

        // Last-Modified header cache for next request
        lastModified: {},

        ajax: function( s ) {
                // Extend the settings, but re-extend 's' so that it can be
                // checked again later (in the test suite, specifically)
                s = jQuery.extend(true, s, jQuery.extend(true, {}, jQuery.ajaxSettings, s));

                var jsonp, jsre = /=\?(&|$)/g, status, data,
                        type = s.type.toUpperCase();

                // convert data if not already a string
                if ( s.data && s.processData && typeof s.data != "string" )
                        s.data = jQuery.param(s.data);

                // Handle JSONP Parameter Callbacks
                if ( s.dataType == "jsonp" ) {
                        if ( type == "GET" ) {
                                if ( !s.url.match(jsre) )
                                        s.url += (s.url.match(/\?/) ? "&" : "?") + (s.jsonp || "callback") + "=?";
                        } else if ( !s.data || !s.data.match(jsre) )
                                s.data = (s.data ? s.data + "&" : "") + (s.jsonp || "callback") + "=?";
                        s.dataType = "json";
                }

                // Build temporary JSONP function
                if ( s.dataType == "json" && (s.data && s.data.match(jsre) || s.url.match(jsre)) ) {
                        jsonp = "jsonp" + jsc++;

                        // Replace the =? sequence both in the query string and the data
                        if ( s.data )
                                s.data = (s.data + "").replace(jsre, "=" + jsonp + "$1");
                        s.url = s.url.replace(jsre, "=" + jsonp + "$1");

                        // We need to make sure
                        // that a JSONP style response is executed properly
                        s.dataType = "script";

                        // Handle JSONP-style loading
                        window[ jsonp ] = function(tmp){
                                data = tmp;
                                success();
                                complete();
                                // Garbage collect
                                window[ jsonp ] = undefined;
                                try{ delete window[ jsonp ]; } catch(e){}
                                if ( head )
                                        head.removeChild( script );
                        };
                }

                if ( s.dataType == "script" && s.cache == null )
                        s.cache = false;

                if ( s.cache === false && type == "GET" ) {
                        var ts = now();
                        // try replacing _= if it is there
                        var ret = s.url.replace(/(\?|&)_=.*?(&|$)/, "$1_=" + ts + "$2");
                        // if nothing was replaced, add timestamp to the end
                        s.url = ret + ((ret == s.url) ? (s.url.match(/\?/) ? "&" : "?") + "_=" + ts : "");
                }

                // If data is available, append data to url for get requests
                if ( s.data && type == "GET" ) {
                        s.url += (s.url.match(/\?/) ? "&" : "?") + s.data;

                        // IE likes to send both get and post data, prevent this
                        s.data = null;
                }

                // Watch for a new set of requests
                if ( s.global && ! jQuery.active++ )
                        jQuery.event.trigger( "ajaxStart" );

                // Matches an absolute URL, and saves the domain
                var remote = /^(?:\w+:)?\/\/([^\/?#]+)/;

                // If we're requesting a remote document
                // and trying to load JSON or Script with a GET
                if ( s.dataType == "script" && type == "GET"
                                && remote.test(s.url) && remote.exec(s.url)[1] != location.host ){
                        var head = document.getElementsByTagName("head")[0];
                        var script = document.createElement("script");
                        script.src = s.url;
                        if (s.scriptCharset)
                                script.charset = s.scriptCharset;

                        // Handle Script loading
                        if ( !jsonp ) {
                                var done = false;

                                // Attach handlers for all browsers
                                script.onload = script.onreadystatechange = function(){
                                        if ( !done && (!this.readyState ||
                                                        this.readyState == "loaded" || this.readyState == "complete") ) {
                                                done = true;
                                                success();
                                                complete();
                                                head.removeChild( script );
                                        }
                                };
                        }

                        head.appendChild(script);

                        // We handle everything using the script element injection
                        return undefined;
                }

                var requestDone = false;

                // Create the request object; Microsoft failed to properly
                // implement the XMLHttpRequest in IE7, so we use the ActiveXObject when it is available
                var xhr = window.ActiveXObject ? new ActiveXObject("Microsoft.XMLHTTP") : new XMLHttpRequest();

                // Open the socket
                // Passing null username, generates a login popup on Opera (#2865)
                if( s.username )
                        xhr.open(type, s.url, s.async, s.username, s.password);
                else
                        xhr.open(type, s.url, s.async);

                // Need an extra try/catch for cross domain requests in Firefox 3
                try {
                        // Set the correct header, if data is being sent
                        if ( s.data )
                                xhr.setRequestHeader("Content-Type", s.contentType);

                        // Set the If-Modified-Since header, if ifModified mode.
                        if ( s.ifModified )
                                xhr.setRequestHeader("If-Modified-Since",
                                        jQuery.lastModified[s.url] || "Thu, 01 Jan 1970 00:00:00 GMT" );

                        // Set header so the called script knows that it's an XMLHttpRequest
                        xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");

                        // Set the Accepts header for the server, depending on the dataType
                        xhr.setRequestHeader("Accept", s.dataType && s.accepts[ s.dataType ] ?
                                s.accepts[ s.dataType ] + ", */*" :
                                s.accepts._default );
                } catch(e){}

                // Allow custom headers/mimetypes
                if ( s.beforeSend && s.beforeSend(xhr, s) === false ) {
                        // cleanup active request counter
                        s.global && jQuery.active--;
                        // close opended socket
                        xhr.abort();
                        return false;
                }

                if ( s.global )
                        jQuery.event.trigger("ajaxSend", [xhr, s]);

                // Wait for a response to come back
                var onreadystatechange = function(isTimeout){
                        // The transfer is complete and the data is available, or the request timed out
                        if ( !requestDone && xhr && (xhr.readyState == 4 || isTimeout == "timeout") ) {
                                requestDone = true;

                                // clear poll interval
                                if (ival) {
                                        clearInterval(ival);
                                        ival = null;
                                }

                                status = isTimeout == "timeout" ? "timeout" :
                                        !jQuery.httpSuccess( xhr ) ? "error" :
                                        s.ifModified && jQuery.httpNotModified( xhr, s.url ) ? "notmodified" :
                                        "success";

                                if ( status == "success" ) {
                                        // Watch for, and catch, XML document parse errors
                                        try {
                                                // process the data (runs the xml through httpData regardless of callback)
                                                data = jQuery.httpData( xhr, s.dataType, s.dataFilter );
                                        } catch(e) {
                                                status = "parsererror";
                                        }
                                }

                                // Make sure that the request was successful or notmodified
                                if ( status == "success" ) {
                                        // Cache Last-Modified header, if ifModified mode.
                                        var modRes;
                                        try {
                                                modRes = xhr.getResponseHeader("Last-Modified");
                                        } catch(e) {} // swallow exception thrown by FF if header is not available

                                        if ( s.ifModified && modRes )
                                                jQuery.lastModified[s.url] = modRes;

                                        // JSONP handles its own success callback
                                        if ( !jsonp )
                                                success();
                                } else
                                        jQuery.handleError(s, xhr, status);

                                // Fire the complete handlers
                                complete();

                                // Stop memory leaks
                                if ( s.async )
                                        xhr = null;
                        }
                };

                if ( s.async ) {
                        // don't attach the handler to the request, just poll it instead
                        var ival = setInterval(onreadystatechange, 13);

                        // Timeout checker
                        if ( s.timeout > 0 )
                                setTimeout(function(){
                                        // Check to see if the request is still happening
                                        if ( xhr ) {
                                                // Cancel the request
                                                xhr.abort();

                                                if( !requestDone )
                                                        onreadystatechange( "timeout" );
                                        }
                                }, s.timeout);
                }

                // Send the data
                try {
                        xhr.send(s.data);
                } catch(e) {
                        jQuery.handleError(s, xhr, null, e);
                }

                // firefox 1.5 doesn't fire statechange for sync requests
                if ( !s.async )
                        onreadystatechange();

                function success(){
                        // If a local callback was specified, fire it and pass it the data
                        if ( s.success )
                                s.success( data, status );

                        // Fire the global callback
                        if ( s.global )
                                jQuery.event.trigger( "ajaxSuccess", [xhr, s] );
                }

                function complete(){
                        // Process result
                        if ( s.complete )
                                s.complete(xhr, status);

                        // The request was completed
                        if ( s.global )
                                jQuery.event.trigger( "ajaxComplete", [xhr, s] );

                        // Handle the global AJAX counter
                        if ( s.global && ! --jQuery.active )
                                jQuery.event.trigger( "ajaxStop" );
                }

                // return XMLHttpRequest to allow aborting the request etc.
                return xhr;
        },

        handleError: function( s, xhr, status, e ) {
                // If a local callback was specified, fire it
                if ( s.error ) s.error( xhr, status, e );

                // Fire the global callback
                if ( s.global )
                        jQuery.event.trigger( "ajaxError", [xhr, s, e] );
        },

        // Counter for holding the number of active queries
        active: 0,

        // Determines if an XMLHttpRequest was successful or not
        httpSuccess: function( xhr ) {
                try {
                        // IE error sometimes returns 1223 when it should be 204 so treat it as success, see #1450
                        return !xhr.status && location.protocol == "file:" ||
                                ( xhr.status >= 200 && xhr.status < 300 ) || xhr.status == 304 || xhr.status == 1223 ||
                                jQuery.browser.safari && xhr.status == undefined;
                } catch(e){}
                return false;
        },

        // Determines if an XMLHttpRequest returns NotModified
        httpNotModified: function( xhr, url ) {
                try {
                        var xhrRes = xhr.getResponseHeader("Last-Modified");

                        // Firefox always returns 200. check Last-Modified date
                        return xhr.status == 304 || xhrRes == jQuery.lastModified[url] ||
                                jQuery.browser.safari && xhr.status == undefined;
                } catch(e){}
                return false;
        },

        httpData: function( xhr, type, filter ) {
                var ct = xhr.getResponseHeader("content-type"),
                        xml = type == "xml" || !type && ct && ct.indexOf("xml") >= 0,
                        data = xml ? xhr.responseXML : xhr.responseText;

                if ( xml && data.documentElement.tagName == "parsererror" )
                        throw "parsererror";
                        
                // Allow a pre-filtering function to sanitize the response
                if( filter )
                        data = filter( data, type );

                // If the type is "script", eval it in global context
                if ( type == "script" )
                        jQuery.globalEval( data );

                // Get the JavaScript object, if JSON is used.
                if ( type == "json" )
                        data = eval("(" + data + ")");

                return data;
        },

        // Serialize an array of form elements or a set of
        // key/values into a query string
        param: function( a ) {
                var s = [ ];

                function add( key, value ){
                        s[ s.length ] = encodeURIComponent(key) + '=' + encodeURIComponent(value);
                };

                // If an array was passed in, assume that it is an array
                // of form elements
                if ( a.constructor == Array || a.jquery )
                        // Serialize the form elements
                        jQuery.each( a, function(){
                                add( this.name, this.value );
                        });

                // Otherwise, assume that it's an object of key/value pairs
                else
                        // Serialize the key/values
                        for ( var j in a )
                                // If the value is an array then the key names need to be repeated
                                if ( a[j] && a[j].constructor == Array )
                                        jQuery.each( a[j], function(){
                                                add( j, this );
                                        });
                                else
                                        add( j, jQuery.isFunction(a[j]) ? a[j]() : a[j] );

                // Return the resulting serialization
                return s.join("&").replace(/%20/g, "+");
        }

});
jQuery.fn.extend({
        show: function(speed,callback){
                return speed ?
                        this.animate({
                                height: "show", width: "show", opacity: "show"
                        }, speed, callback) :

                        this.filter(":hidden").each(function(){
                                this.style.display = this.oldblock || "";
                                if ( jQuery.css(this,"display") == "none" ) {
                                        var elem = jQuery("<" + this.tagName + " />").appendTo("body");
                                        this.style.display = elem.css("display");
                                        // handle an edge condition where css is - div { display:none; } or similar
                                        if (this.style.display == "none")
                                                this.style.display = "block";
                                        elem.remove();
                                }
                        }).end();
        },

        hide: function(speed,callback){
                return speed ?
                        this.animate({
                                height: "hide", width: "hide", opacity: "hide"
                        }, speed, callback) :

                        this.filter(":visible").each(function(){
                                this.oldblock = this.oldblock || jQuery.css(this,"display");
                                this.style.display = "none";
                        }).end();
        },

        // Save the old toggle function
        _toggle: jQuery.fn.toggle,

        toggle: function( fn, fn2 ){
                return jQuery.isFunction(fn) && jQuery.isFunction(fn2) ?
                        this._toggle.apply( this, arguments ) :
                        fn ?
                                this.animate({
                                        height: "toggle", width: "toggle", opacity: "toggle"
                                }, fn, fn2) :
                                this.each(function(){
                                        jQuery(this)[ jQuery(this).is(":hidden") ? "show" : "hide" ]();
                                });
        },

        slideDown: function(speed,callback){
                return this.animate({height: "show"}, speed, callback);
        },

        slideUp: function(speed,callback){
                return this.animate({height: "hide"}, speed, callback);
        },

        slideToggle: function(speed, callback){
                return this.animate({height: "toggle"}, speed, callback);
        },

        fadeIn: function(speed, callback){
                return this.animate({opacity: "show"}, speed, callback);
        },

        fadeOut: function(speed, callback){
                return this.animate({opacity: "hide"}, speed, callback);
        },

        fadeTo: function(speed,to,callback){
                return this.animate({opacity: to}, speed, callback);
        },

        animate: function( prop, speed, easing, callback ) {
                var optall = jQuery.speed(speed, easing, callback);

                return this[ optall.queue === false ? "each" : "queue" ](function(){
                        if ( this.nodeType != 1)
                                return false;

                        var opt = jQuery.extend({}, optall), p,
                                hidden = jQuery(this).is(":hidden"), self = this;

                        for ( p in prop ) {
                                if ( prop[p] == "hide" && hidden || prop[p] == "show" && !hidden )
                                        return opt.complete.call(this);

                                if ( p == "height" || p == "width" ) {
                                        // Store display property
                                        opt.display = jQuery.css(this, "display");

                                        // Make sure that nothing sneaks out
                                        opt.overflow = this.style.overflow;
                                }
                        }

                        if ( opt.overflow != null )
                                this.style.overflow = "hidden";

                        opt.curAnim = jQuery.extend({}, prop);

                        jQuery.each( prop, function(name, val){
                                var e = new jQuery.fx( self, opt, name );

                                if ( /toggle|show|hide/.test(val) )
                                        e[ val == "toggle" ? hidden ? "show" : "hide" : val ]( prop );
                                else {
                                        var parts = val.toString().match(/^([+-]=)?([\d+-.]+)(.*)$/),
                                                start = e.cur(true) || 0;

                                        if ( parts ) {
                                                var end = parseFloat(parts[2]),
                                                        unit = parts[3] || "px";

                                                // We need to compute starting value
                                                if ( unit != "px" ) {
                                                        self.style[ name ] = (end || 1) + unit;
                                                        start = ((end || 1) / e.cur(true)) * start;
                                                        self.style[ name ] = start + unit;
                                                }

                                                // If a +=/-= token was provided, we're doing a relative animation
                                                if ( parts[1] )
                                                        end = ((parts[1] == "-=" ? -1 : 1) * end) + start;

                                                e.custom( start, end, unit );
                                        } else
                                                e.custom( start, val, "" );
                                }
                        });

                        // For JS strict compliance
                        return true;
                });
        },

        queue: function(type, fn){
                if ( jQuery.isFunction(type) || ( type && type.constructor == Array )) {
                        fn = type;
                        type = "fx";
                }

                if ( !type || (typeof type == "string" && !fn) )
                        return queue( this[0], type );

                return this.each(function(){
                        if ( fn.constructor == Array )
                                queue(this, type, fn);
                        else {
                                queue(this, type).push( fn );

                                if ( queue(this, type).length == 1 )
                                        fn.call(this);
                        }
                });
        },

        stop: function(clearQueue, gotoEnd){
                var timers = jQuery.timers;

                if (clearQueue)
                        this.queue([]);

                this.each(function(){
                        // go in reverse order so anything added to the queue during the loop is ignored
                        for ( var i = timers.length - 1; i >= 0; i-- )
                                if ( timers[i].elem == this ) {
                                        if (gotoEnd)
                                                // force the next step to be the last
                                                timers[i](true);
                                        timers.splice(i, 1);
                                }
                });

                // start the next in the queue if the last step wasn't forced
                if (!gotoEnd)
                        this.dequeue();

                return this;
        }

});

var queue = function( elem, type, array ) {
        if ( elem ){

                type = type || "fx";

                var q = jQuery.data( elem, type + "queue" );

                if ( !q || array )
                        q = jQuery.data( elem, type + "queue", jQuery.makeArray(array) );

        }
        return q;
};

jQuery.fn.dequeue = function(type){
        type = type || "fx";

        return this.each(function(){
                var q = queue(this, type);

                q.shift();

                if ( q.length )
                        q[0].call( this );
        });
};

jQuery.extend({

        speed: function(speed, easing, fn) {
                var opt = speed && speed.constructor == Object ? speed : {
                        complete: fn || !fn && easing ||
                                jQuery.isFunction( speed ) && speed,
                        duration: speed,
                        easing: fn && easing || easing && easing.constructor != Function && easing
                };

                opt.duration = (opt.duration && opt.duration.constructor == Number ?
                        opt.duration :
                        jQuery.fx.speeds[opt.duration]) || jQuery.fx.speeds.def;

                // Queueing
                opt.old = opt.complete;
                opt.complete = function(){
                        if ( opt.queue !== false )
                                jQuery(this).dequeue();
                        if ( jQuery.isFunction( opt.old ) )
                                opt.old.call( this );
                };

                return opt;
        },

        easing: {
                linear: function( p, n, firstNum, diff ) {
                        return firstNum + diff * p;
                },
                swing: function( p, n, firstNum, diff ) {
                        return ((-Math.cos(p*Math.PI)/2) + 0.5) * diff + firstNum;
                }
        },

        timers: [],
        timerId: null,

        fx: function( elem, options, prop ){
                this.options = options;
                this.elem = elem;
                this.prop = prop;

                if ( !options.orig )
                        options.orig = {};
        }

});

jQuery.fx.prototype = {

        // Simple function for setting a style value
        update: function(){
                if ( this.options.step )
                        this.options.step.call( this.elem, this.now, this );

                (jQuery.fx.step[this.prop] || jQuery.fx.step._default)( this );

                // Set display property to block for height/width animations
                if ( this.prop == "height" || this.prop == "width" )
                        this.elem.style.display = "block";
        },

        // Get the current size
        cur: function(force){
                if ( this.elem[this.prop] != null && this.elem.style[this.prop] == null )
                        return this.elem[ this.prop ];

                var r = parseFloat(jQuery.css(this.elem, this.prop, force));
                return r && r > -10000 ? r : parseFloat(jQuery.curCSS(this.elem, this.prop)) || 0;
        },

        // Start an animation from one number to another
        custom: function(from, to, unit){
                this.startTime = now();
                this.start = from;
                this.end = to;
                this.unit = unit || this.unit || "px";
                this.now = this.start;
                this.pos = this.state = 0;
                this.update();

                var self = this;
                function t(gotoEnd){
                        return self.step(gotoEnd);
                }

                t.elem = this.elem;

                jQuery.timers.push(t);

                if ( jQuery.timerId == null ) {
                        jQuery.timerId = setInterval(function(){
                                var timers = jQuery.timers;

                                for ( var i = 0; i < timers.length; i++ )
                                        if ( !timers[i]() )
                                                timers.splice(i--, 1);

                                if ( !timers.length ) {
                                        clearInterval( jQuery.timerId );
                                        jQuery.timerId = null;
                                }
                        }, 13);
                }
        },

        // Simple 'show' function
        show: function(){
                // Remember where we started, so that we can go back to it later
                this.options.orig[this.prop] = jQuery.attr( this.elem.style, this.prop );
                this.options.show = true;

                // Begin the animation
                this.custom(0, this.cur());

                // Make sure that we start at a small width/height to avoid any
                // flash of content
                if ( this.prop == "width" || this.prop == "height" )
                        this.elem.style[this.prop] = "1px";

                // Start by showing the element
                jQuery(this.elem).show();
        },

        // Simple 'hide' function
        hide: function(){
                // Remember where we started, so that we can go back to it later
                this.options.orig[this.prop] = jQuery.attr( this.elem.style, this.prop );
                this.options.hide = true;

                // Begin the animation
                this.custom(this.cur(), 0);
        },

        // Each step of an animation
        step: function(gotoEnd){
                var t = now();

                if ( gotoEnd || t > this.options.duration + this.startTime ) {
                        this.now = this.end;
                        this.pos = this.state = 1;
                        this.update();

                        this.options.curAnim[ this.prop ] = true;

                        var done = true;
                        for ( var i in this.options.curAnim )
                                if ( this.options.curAnim[i] !== true )
                                        done = false;

                        if ( done ) {
                                if ( this.options.display != null ) {
                                        // Reset the overflow
                                        this.elem.style.overflow = this.options.overflow;

                                        // Reset the display
                                        this.elem.style.display = this.options.display;
                                        if ( jQuery.css(this.elem, "display") == "none" )
                                                this.elem.style.display = "block";
                                }

                                // Hide the element if the "hide" operation was done
                                if ( this.options.hide )
                                        this.elem.style.display = "none";

                                // Reset the properties, if the item has been hidden or shown
                                if ( this.options.hide || this.options.show )
                                        for ( var p in this.options.curAnim )
                                                jQuery.attr(this.elem.style, p, this.options.orig[p]);
                        }

                        if ( done )
                                // Execute the complete function
                                this.options.complete.call( this.elem );

                        return false;
                } else {
                        var n = t - this.startTime;
                        this.state = n / this.options.duration;

                        // Perform the easing function, defaults to swing
                        this.pos = jQuery.easing[this.options.easing || (jQuery.easing.swing ? "swing" : "linear")](this.state, n, 0, 1, this.options.duration);
                        this.now = this.start + ((this.end - this.start) * this.pos);

                        // Perform the next step of the animation
                        this.update();
                }

                return true;
        }

};

jQuery.extend( jQuery.fx, {
        speeds:{
                slow: 600,
                fast: 200,
                // Default speed
                def: 400
        },
        step: {
                scrollLeft: function(fx){
                        fx.elem.scrollLeft = fx.now;
                },

                scrollTop: function(fx){
                        fx.elem.scrollTop = fx.now;
                },

                opacity: function(fx){
                        jQuery.attr(fx.elem.style, "opacity", fx.now);
                },

                _default: function(fx){
                        fx.elem.style[ fx.prop ] = fx.now + fx.unit;
                }
        }
});
// The Offset Method
// Originally By Brandon Aaron, part of the Dimension Plugin
// http://jquery.com/plugins/project/dimensions
jQuery.fn.offset = function() {
        var left = 0, top = 0, elem = this[0], results;

        if ( elem ) with ( jQuery.browser ) {
                var parent       = elem.parentNode,
                    offsetChild  = elem,
                    offsetParent = elem.offsetParent,
                    doc          = elem.ownerDocument,
                    safari2      = safari && parseInt(version) < 522 && !/adobeair/i.test(userAgent),
                    css          = jQuery.curCSS,
                    fixed        = css(elem, "position") == "fixed";

                // Use getBoundingClientRect if available
                if ( !(mozilla && elem == document.body) && elem.getBoundingClientRect ) {
                        var box = elem.getBoundingClientRect();

                        // Add the document scroll offsets
                        add(box.left + Math.max(doc.documentElement.scrollLeft, doc.body.scrollLeft),
                                box.top  + Math.max(doc.documentElement.scrollTop,  doc.body.scrollTop));

                        // IE adds the HTML element's border, by default it is medium which is 2px
                        // IE 6 and 7 quirks mode the border width is overwritable by the following css html { border: 0; }
                        // IE 7 standards mode, the border is always 2px
                        // This border/offset is typically represented by the clientLeft and clientTop properties
                        // However, in IE6 and 7 quirks mode the clientLeft and clientTop properties are not updated when overwriting it via CSS
                        // Therefore this method will be off by 2px in IE while in quirksmode
                        add( -doc.documentElement.clientLeft, -doc.documentElement.clientTop );

                // Otherwise loop through the offsetParents and parentNodes
                } else {

                        // Initial element offsets
                        add( elem.offsetLeft, elem.offsetTop );

                        // Get parent offsets
                        while ( offsetParent ) {
                                // Add offsetParent offsets
                                add( offsetParent.offsetLeft, offsetParent.offsetTop );

                                // Mozilla and Safari > 2 does not include the border on offset parents
                                // However Mozilla adds the border for table or table cells
                                if ( mozilla && !/^t(able|d|h)$/i.test(offsetParent.tagName) || safari && !safari2 )
                                        border( offsetParent );

                                // Add the document scroll offsets if position is fixed on any offsetParent
                                if ( !fixed && css(offsetParent, "position") == "fixed" )
                                        fixed = true;

                                // Set offsetChild to previous offsetParent unless it is the body element
                                offsetChild  = /^body$/i.test(offsetParent.tagName) ? offsetChild : offsetParent;
                                // Get next offsetParent
                                offsetParent = offsetParent.offsetParent;
                        }

                        // Get parent scroll offsets
                        while ( parent && parent.tagName && !/^body|html$/i.test(parent.tagName) ) {
                                // Remove parent scroll UNLESS that parent is inline or a table to work around Opera inline/table scrollLeft/Top bug
                                if ( !/^inline|table.*$/i.test(css(parent, "display")) )
                                        // Subtract parent scroll offsets
                                        add( -parent.scrollLeft, -parent.scrollTop );

                                // Mozilla does not add the border for a parent that has overflow != visible
                                if ( mozilla && css(parent, "overflow") != "visible" )
                                        border( parent );

                                // Get next parent
                                parent = parent.parentNode;
                        }

                        // Safari <= 2 doubles body offsets with a fixed position element/offsetParent or absolutely positioned offsetChild
                        // Mozilla doubles body offsets with a non-absolutely positioned offsetChild
                        if ( (safari2 && (fixed || css(offsetChild, "position") == "absolute")) ||
                                (mozilla && css(offsetChild, "position") != "absolute") )
                                        add( -doc.body.offsetLeft, -doc.body.offsetTop );

                        // Add the document scroll offsets if position is fixed
                        if ( fixed )
                                add(Math.max(doc.documentElement.scrollLeft, doc.body.scrollLeft),
                                        Math.max(doc.documentElement.scrollTop,  doc.body.scrollTop));
                }

                // Return an object with top and left properties
                results = { top: top, left: left };
        }

        function border(elem) {
                add( jQuery.curCSS(elem, "borderLeftWidth", true), jQuery.curCSS(elem, "borderTopWidth", true) );
        }

        function add(l, t) {
                left += parseInt(l, 10) || 0;
                top += parseInt(t, 10) || 0;
        }

        return results;
};


jQuery.fn.extend({
        position: function() {
                var left = 0, top = 0, results;

                if ( this[0] ) {
                        // Get *real* offsetParent
                        var offsetParent = this.offsetParent(),

                        // Get correct offsets
                        offset       = this.offset(),
                        parentOffset = /^body|html$/i.test(offsetParent[0].tagName) ? { top: 0, left: 0 } : offsetParent.offset();

                        // Subtract element margins
                        // note: when an element has margin: auto the offsetLeft and marginLeft 
                        // are the same in Safari causing offset.left to incorrectly be 0
                        offset.top  -= num( this, 'marginTop' );
                        offset.left -= num( this, 'marginLeft' );

                        // Add offsetParent borders
                        parentOffset.top  += num( offsetParent, 'borderTopWidth' );
                        parentOffset.left += num( offsetParent, 'borderLeftWidth' );

                        // Subtract the two offsets
                        results = {
                                top:  offset.top  - parentOffset.top,
                                left: offset.left - parentOffset.left
                        };
                }

                return results;
        },

        offsetParent: function() {
                var offsetParent = this[0].offsetParent;
                while ( offsetParent && (!/^body|html$/i.test(offsetParent.tagName) && jQuery.css(offsetParent, 'position') == 'static') )
                        offsetParent = offsetParent.offsetParent;
                return jQuery(offsetParent);
        }
});


// Create scrollLeft and scrollTop methods
jQuery.each( ['Left', 'Top'], function(i, name) {
        var method = 'scroll' + name;
        
        jQuery.fn[ method ] = function(val) {
                if (!this[0]) return;

                return val != undefined ?

                        // Set the scroll offset
                        this.each(function() {
                                this == window || this == document ?
                                        window.scrollTo(
                                                !i ? val : jQuery(window).scrollLeft(),
                                                 i ? val : jQuery(window).scrollTop()
                                        ) :
                                        this[ method ] = val;
                        }) :

                        // Return the scroll offset
                        this[0] == window || this[0] == document ?
                                self[ i ? 'pageYOffset' : 'pageXOffset' ] ||
                                        jQuery.boxModel && document.documentElement[ method ] ||
                                        document.body[ method ] :
                                this[0][ method ];
        };
});
// Create innerHeight, innerWidth, outerHeight and outerWidth methods
jQuery.each([ "Height", "Width" ], function(i, name){

        var tl = i ? "Left"  : "Top",  // top or left
                br = i ? "Right" : "Bottom"; // bottom or right

        // innerHeight and innerWidth
        jQuery.fn["inner" + name] = function(){
                return this[ name.toLowerCase() ]() +
                        num(this, "padding" + tl) +
                        num(this, "padding" + br);
        };

        // outerHeight and outerWidth
        jQuery.fn["outer" + name] = function(margin) {
                return this["inner" + name]() +
                        num(this, "border" + tl + "Width") +
                        num(this, "border" + br + "Width") +
                        (margin ?
                                num(this, "margin" + tl) + num(this, "margin" + br) : 0);
        };

});})();
 
/*!
 * jQuery JavaScript Library v1.4.4
 * http://jquery.com/
 *
 * Copyright 2010, John Resig
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://jquery.org/license
 *
 * Includes Sizzle.js
 * http://sizzlejs.com/
 * Copyright 2010, The Dojo Foundation
 * Released under the MIT, BSD, and GPL Licenses.
 *
 * Date: Thu Nov 11 19:04:53 2010 -0500
 */
(function(E,B){function ka(a,b,d){if(d===B&&a.nodeType===1){d=a.getAttribute("data-"+b);if(typeof d==="string"){try{d=d==="true"?true:d==="false"?false:d==="null"?null:!c.isNaN(d)?parseFloat(d):Ja.test(d)?c.parseJSON(d):d}catch(e){}c.data(a,b,d)}else d=B}return d}function U(){return false}function ca(){return true}function la(a,b,d){d[0].type=a;return c.event.handle.apply(b,d)}function Ka(a){var b,d,e,f,h,l,k,o,x,r,A,C=[];f=[];h=c.data(this,this.nodeType?"events":"__events__");if(typeof h==="function")h=
h.events;if(!(a.liveFired===this||!h||!h.live||a.button&&a.type==="click")){if(a.namespace)A=RegExp("(^|\\.)"+a.namespace.split(".").join("\\.(?:.*\\.)?")+"(\\.|$)");a.liveFired=this;var J=h.live.slice(0);for(k=0;k<J.length;k++){h=J[k];h.origType.replace(X,"")===a.type?f.push(h.selector):J.splice(k--,1)}f=c(a.target).closest(f,a.currentTarget);o=0;for(x=f.length;o<x;o++){r=f[o];for(k=0;k<J.length;k++){h=J[k];if(r.selector===h.selector&&(!A||A.test(h.namespace))){l=r.elem;e=null;if(h.preType==="mouseenter"||
h.preType==="mouseleave"){a.type=h.preType;e=c(a.relatedTarget).closest(h.selector)[0]}if(!e||e!==l)C.push({elem:l,handleObj:h,level:r.level})}}}o=0;for(x=C.length;o<x;o++){f=C[o];if(d&&f.level>d)break;a.currentTarget=f.elem;a.data=f.handleObj.data;a.handleObj=f.handleObj;A=f.handleObj.origHandler.apply(f.elem,arguments);if(A===false||a.isPropagationStopped()){d=f.level;if(A===false)b=false;if(a.isImmediatePropagationStopped())break}}return b}}function Y(a,b){return(a&&a!=="*"?a+".":"")+b.replace(La,
"`").replace(Ma,"&")}function ma(a,b,d){if(c.isFunction(b))return c.grep(a,function(f,h){return!!b.call(f,h,f)===d});else if(b.nodeType)return c.grep(a,function(f){return f===b===d});else if(typeof b==="string"){var e=c.grep(a,function(f){return f.nodeType===1});if(Na.test(b))return c.filter(b,e,!d);else b=c.filter(b,e)}return c.grep(a,function(f){return c.inArray(f,b)>=0===d})}function na(a,b){var d=0;b.each(function(){if(this.nodeName===(a[d]&&a[d].nodeName)){var e=c.data(a[d++]),f=c.data(this,
e);if(e=e&&e.events){delete f.handle;f.events={};for(var h in e)for(var l in e[h])c.event.add(this,h,e[h][l],e[h][l].data)}}})}function Oa(a,b){b.src?c.ajax({url:b.src,async:false,dataType:"script"}):c.globalEval(b.text||b.textContent||b.innerHTML||"");b.parentNode&&b.parentNode.removeChild(b)}function oa(a,b,d){var e=b==="width"?a.offsetWidth:a.offsetHeight;if(d==="border")return e;c.each(b==="width"?Pa:Qa,function(){d||(e-=parseFloat(c.css(a,"padding"+this))||0);if(d==="margin")e+=parseFloat(c.css(a,
"margin"+this))||0;else e-=parseFloat(c.css(a,"border"+this+"Width"))||0});return e}function da(a,b,d,e){if(c.isArray(b)&&b.length)c.each(b,function(f,h){d||Ra.test(a)?e(a,h):da(a+"["+(typeof h==="object"||c.isArray(h)?f:"")+"]",h,d,e)});else if(!d&&b!=null&&typeof b==="object")c.isEmptyObject(b)?e(a,""):c.each(b,function(f,h){da(a+"["+f+"]",h,d,e)});else e(a,b)}function S(a,b){var d={};c.each(pa.concat.apply([],pa.slice(0,b)),function(){d[this]=a});return d}function qa(a){if(!ea[a]){var b=c("<"+
a+">").appendTo("body"),d=b.css("display");b.remove();if(d==="none"||d==="")d="block";ea[a]=d}return ea[a]}function fa(a){return c.isWindow(a)?a:a.nodeType===9?a.defaultView||a.parentWindow:false}var t=E.document,c=function(){function a(){if(!b.isReady){try{t.documentElement.doScroll("left")}catch(j){setTimeout(a,1);return}b.ready()}}var b=function(j,s){return new b.fn.init(j,s)},d=E.jQuery,e=E.$,f,h=/^(?:[^<]*(<[\w\W]+>)[^>]*$|#([\w\-]+)$)/,l=/\S/,k=/^\s+/,o=/\s+$/,x=/\W/,r=/\d/,A=/^<(\w+)\s*\/?>(?:<\/\1>)?$/,
C=/^[\],:{}\s]*$/,J=/\\(?:["\\\/bfnrt]|u[0-9a-fA-F]{4})/g,w=/"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g,I=/(?:^|:|,)(?:\s*\[)+/g,L=/(webkit)[ \/]([\w.]+)/,g=/(opera)(?:.*version)?[ \/]([\w.]+)/,i=/(msie) ([\w.]+)/,n=/(mozilla)(?:.*? rv:([\w.]+))?/,m=navigator.userAgent,p=false,q=[],u,y=Object.prototype.toString,F=Object.prototype.hasOwnProperty,M=Array.prototype.push,N=Array.prototype.slice,O=String.prototype.trim,D=Array.prototype.indexOf,R={};b.fn=b.prototype={init:function(j,
s){var v,z,H;if(!j)return this;if(j.nodeType){this.context=this[0]=j;this.length=1;return this}if(j==="body"&&!s&&t.body){this.context=t;this[0]=t.body;this.selector="body";this.length=1;return this}if(typeof j==="string")if((v=h.exec(j))&&(v[1]||!s))if(v[1]){H=s?s.ownerDocument||s:t;if(z=A.exec(j))if(b.isPlainObject(s)){j=[t.createElement(z[1])];b.fn.attr.call(j,s,true)}else j=[H.createElement(z[1])];else{z=b.buildFragment([v[1]],[H]);j=(z.cacheable?z.fragment.cloneNode(true):z.fragment).childNodes}return b.merge(this,
j)}else{if((z=t.getElementById(v[2]))&&z.parentNode){if(z.id!==v[2])return f.find(j);this.length=1;this[0]=z}this.context=t;this.selector=j;return this}else if(!s&&!x.test(j)){this.selector=j;this.context=t;j=t.getElementsByTagName(j);return b.merge(this,j)}else return!s||s.jquery?(s||f).find(j):b(s).find(j);else if(b.isFunction(j))return f.ready(j);if(j.selector!==B){this.selector=j.selector;this.context=j.context}return b.makeArray(j,this)},selector:"",jquery:"1.4.4",length:0,size:function(){return this.length},
toArray:function(){return N.call(this,0)},get:function(j){return j==null?this.toArray():j<0?this.slice(j)[0]:this[j]},pushStack:function(j,s,v){var z=b();b.isArray(j)?M.apply(z,j):b.merge(z,j);z.prevObject=this;z.context=this.context;if(s==="find")z.selector=this.selector+(this.selector?" ":"")+v;else if(s)z.selector=this.selector+"."+s+"("+v+")";return z},each:function(j,s){return b.each(this,j,s)},ready:function(j){b.bindReady();if(b.isReady)j.call(t,b);else q&&q.push(j);return this},eq:function(j){return j===
-1?this.slice(j):this.slice(j,+j+1)},first:function(){return this.eq(0)},last:function(){return this.eq(-1)},slice:function(){return this.pushStack(N.apply(this,arguments),"slice",N.call(arguments).join(","))},map:function(j){return this.pushStack(b.map(this,function(s,v){return j.call(s,v,s)}))},end:function(){return this.prevObject||b(null)},push:M,sort:[].sort,splice:[].splice};b.fn.init.prototype=b.fn;b.extend=b.fn.extend=function(){var j,s,v,z,H,G=arguments[0]||{},K=1,Q=arguments.length,ga=false;
if(typeof G==="boolean"){ga=G;G=arguments[1]||{};K=2}if(typeof G!=="object"&&!b.isFunction(G))G={};if(Q===K){G=this;--K}for(;K<Q;K++)if((j=arguments[K])!=null)for(s in j){v=G[s];z=j[s];if(G!==z)if(ga&&z&&(b.isPlainObject(z)||(H=b.isArray(z)))){if(H){H=false;v=v&&b.isArray(v)?v:[]}else v=v&&b.isPlainObject(v)?v:{};G[s]=b.extend(ga,v,z)}else if(z!==B)G[s]=z}return G};b.extend({noConflict:function(j){E.$=e;if(j)E.jQuery=d;return b},isReady:false,readyWait:1,ready:function(j){j===true&&b.readyWait--;
if(!b.readyWait||j!==true&&!b.isReady){if(!t.body)return setTimeout(b.ready,1);b.isReady=true;if(!(j!==true&&--b.readyWait>0))if(q){var s=0,v=q;for(q=null;j=v[s++];)j.call(t,b);b.fn.trigger&&b(t).trigger("ready").unbind("ready")}}},bindReady:function(){if(!p){p=true;if(t.readyState==="complete")return setTimeout(b.ready,1);if(t.addEventListener){t.addEventListener("DOMContentLoaded",u,false);E.addEventListener("load",b.ready,false)}else if(t.attachEvent){t.attachEvent("onreadystatechange",u);E.attachEvent("onload",
b.ready);var j=false;try{j=E.frameElement==null}catch(s){}t.documentElement.doScroll&&j&&a()}}},isFunction:function(j){return b.type(j)==="function"},isArray:Array.isArray||function(j){return b.type(j)==="array"},isWindow:function(j){return j&&typeof j==="object"&&"setInterval"in j},isNaN:function(j){return j==null||!r.test(j)||isNaN(j)},type:function(j){return j==null?String(j):R[y.call(j)]||"object"},isPlainObject:function(j){if(!j||b.type(j)!=="object"||j.nodeType||b.isWindow(j))return false;if(j.constructor&&
!F.call(j,"constructor")&&!F.call(j.constructor.prototype,"isPrototypeOf"))return false;for(var s in j);return s===B||F.call(j,s)},isEmptyObject:function(j){for(var s in j)return false;return true},error:function(j){throw j;},parseJSON:function(j){if(typeof j!=="string"||!j)return null;j=b.trim(j);if(C.test(j.replace(J,"@").replace(w,"]").replace(I,"")))return E.JSON&&E.JSON.parse?E.JSON.parse(j):(new Function("return "+j))();else b.error("Invalid JSON: "+j)},noop:function(){},globalEval:function(j){if(j&&
l.test(j)){var s=t.getElementsByTagName("head")[0]||t.documentElement,v=t.createElement("script");v.type="text/javascript";if(b.support.scriptEval)v.appendChild(t.createTextNode(j));else v.text=j;s.insertBefore(v,s.firstChild);s.removeChild(v)}},nodeName:function(j,s){return j.nodeName&&j.nodeName.toUpperCase()===s.toUpperCase()},each:function(j,s,v){var z,H=0,G=j.length,K=G===B||b.isFunction(j);if(v)if(K)for(z in j){if(s.apply(j[z],v)===false)break}else for(;H<G;){if(s.apply(j[H++],v)===false)break}else if(K)for(z in j){if(s.call(j[z],
z,j[z])===false)break}else for(v=j[0];H<G&&s.call(v,H,v)!==false;v=j[++H]);return j},trim:O?function(j){return j==null?"":O.call(j)}:function(j){return j==null?"":j.toString().replace(k,"").replace(o,"")},makeArray:function(j,s){var v=s||[];if(j!=null){var z=b.type(j);j.length==null||z==="string"||z==="function"||z==="regexp"||b.isWindow(j)?M.call(v,j):b.merge(v,j)}return v},inArray:function(j,s){if(s.indexOf)return s.indexOf(j);for(var v=0,z=s.length;v<z;v++)if(s[v]===j)return v;return-1},merge:function(j,
s){var v=j.length,z=0;if(typeof s.length==="number")for(var H=s.length;z<H;z++)j[v++]=s[z];else for(;s[z]!==B;)j[v++]=s[z++];j.length=v;return j},grep:function(j,s,v){var z=[],H;v=!!v;for(var G=0,K=j.length;G<K;G++){H=!!s(j[G],G);v!==H&&z.push(j[G])}return z},map:function(j,s,v){for(var z=[],H,G=0,K=j.length;G<K;G++){H=s(j[G],G,v);if(H!=null)z[z.length]=H}return z.concat.apply([],z)},guid:1,proxy:function(j,s,v){if(arguments.length===2)if(typeof s==="string"){v=j;j=v[s];s=B}else if(s&&!b.isFunction(s)){v=
s;s=B}if(!s&&j)s=function(){return j.apply(v||this,arguments)};if(j)s.guid=j.guid=j.guid||s.guid||b.guid++;return s},access:function(j,s,v,z,H,G){var K=j.length;if(typeof s==="object"){for(var Q in s)b.access(j,Q,s[Q],z,H,v);return j}if(v!==B){z=!G&&z&&b.isFunction(v);for(Q=0;Q<K;Q++)H(j[Q],s,z?v.call(j[Q],Q,H(j[Q],s)):v,G);return j}return K?H(j[0],s):B},now:function(){return(new Date).getTime()},uaMatch:function(j){j=j.toLowerCase();j=L.exec(j)||g.exec(j)||i.exec(j)||j.indexOf("compatible")<0&&n.exec(j)||
[];return{browser:j[1]||"",version:j[2]||"0"}},browser:{}});b.each("Boolean Number String Function Array Date RegExp Object".split(" "),function(j,s){R["[object "+s+"]"]=s.toLowerCase()});m=b.uaMatch(m);if(m.browser){b.browser[m.browser]=true;b.browser.version=m.version}if(b.browser.webkit)b.browser.safari=true;if(D)b.inArray=function(j,s){return D.call(s,j)};if(!/\s/.test("\u00a0")){k=/^[\s\xA0]+/;o=/[\s\xA0]+$/}f=b(t);if(t.addEventListener)u=function(){t.removeEventListener("DOMContentLoaded",u,
false);b.ready()};else if(t.attachEvent)u=function(){if(t.readyState==="complete"){t.detachEvent("onreadystatechange",u);b.ready()}};return E.jQuery=E.$=b}();(function(){c.support={};var a=t.documentElement,b=t.createElement("script"),d=t.createElement("div"),e="script"+c.now();d.style.display="none";d.innerHTML="   <link/><table></table><a href='/a' style='color:red;float:left;opacity:.55;'>a</a><input type='checkbox'/>";var f=d.getElementsByTagName("*"),h=d.getElementsByTagName("a")[0],l=t.createElement("select"),
k=l.appendChild(t.createElement("option"));if(!(!f||!f.length||!h)){c.support={leadingWhitespace:d.firstChild.nodeType===3,tbody:!d.getElementsByTagName("tbody").length,htmlSerialize:!!d.getElementsByTagName("link").length,style:/red/.test(h.getAttribute("style")),hrefNormalized:h.getAttribute("href")==="/a",opacity:/^0.55$/.test(h.style.opacity),cssFloat:!!h.style.cssFloat,checkOn:d.getElementsByTagName("input")[0].value==="on",optSelected:k.selected,deleteExpando:true,optDisabled:false,checkClone:false,
scriptEval:false,noCloneEvent:true,boxModel:null,inlineBlockNeedsLayout:false,shrinkWrapBlocks:false,reliableHiddenOffsets:true};l.disabled=true;c.support.optDisabled=!k.disabled;b.type="text/javascript";try{b.appendChild(t.createTextNode("window."+e+"=1;"))}catch(o){}a.insertBefore(b,a.firstChild);if(E[e]){c.support.scriptEval=true;delete E[e]}try{delete b.test}catch(x){c.support.deleteExpando=false}a.removeChild(b);if(d.attachEvent&&d.fireEvent){d.attachEvent("onclick",function r(){c.support.noCloneEvent=
false;d.detachEvent("onclick",r)});d.cloneNode(true).fireEvent("onclick")}d=t.createElement("div");d.innerHTML="<input type='radio' name='radiotest' checked='checked'/>";a=t.createDocumentFragment();a.appendChild(d.firstChild);c.support.checkClone=a.cloneNode(true).cloneNode(true).lastChild.checked;c(function(){var r=t.createElement("div");r.style.width=r.style.paddingLeft="1px";t.body.appendChild(r);c.boxModel=c.support.boxModel=r.offsetWidth===2;if("zoom"in r.style){r.style.display="inline";r.style.zoom=
1;c.support.inlineBlockNeedsLayout=r.offsetWidth===2;r.style.display="";r.innerHTML="<div style='width:4px;'></div>";c.support.shrinkWrapBlocks=r.offsetWidth!==2}r.innerHTML="<table><tr><td style='padding:0;display:none'></td><td>t</td></tr></table>";var A=r.getElementsByTagName("td");c.support.reliableHiddenOffsets=A[0].offsetHeight===0;A[0].style.display="";A[1].style.display="none";c.support.reliableHiddenOffsets=c.support.reliableHiddenOffsets&&A[0].offsetHeight===0;r.innerHTML="";t.body.removeChild(r).style.display=
"none"});a=function(r){var A=t.createElement("div");r="on"+r;var C=r in A;if(!C){A.setAttribute(r,"return;");C=typeof A[r]==="function"}return C};c.support.submitBubbles=a("submit");c.support.changeBubbles=a("change");a=b=d=f=h=null}})();var ra={},Ja=/^(?:\{.*\}|\[.*\])$/;c.extend({cache:{},uuid:0,expando:"jQuery"+c.now(),noData:{embed:true,object:"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000",applet:true},data:function(a,b,d){if(c.acceptData(a)){a=a==E?ra:a;var e=a.nodeType,f=e?a[c.expando]:null,h=
c.cache;if(!(e&&!f&&typeof b==="string"&&d===B)){if(e)f||(a[c.expando]=f=++c.uuid);else h=a;if(typeof b==="object")if(e)h[f]=c.extend(h[f],b);else c.extend(h,b);else if(e&&!h[f])h[f]={};a=e?h[f]:h;if(d!==B)a[b]=d;return typeof b==="string"?a[b]:a}}},removeData:function(a,b){if(c.acceptData(a)){a=a==E?ra:a;var d=a.nodeType,e=d?a[c.expando]:a,f=c.cache,h=d?f[e]:e;if(b){if(h){delete h[b];d&&c.isEmptyObject(h)&&c.removeData(a)}}else if(d&&c.support.deleteExpando)delete a[c.expando];else if(a.removeAttribute)a.removeAttribute(c.expando);
else if(d)delete f[e];else for(var l in a)delete a[l]}},acceptData:function(a){if(a.nodeName){var b=c.noData[a.nodeName.toLowerCase()];if(b)return!(b===true||a.getAttribute("classid")!==b)}return true}});c.fn.extend({data:function(a,b){var d=null;if(typeof a==="undefined"){if(this.length){var e=this[0].attributes,f;d=c.data(this[0]);for(var h=0,l=e.length;h<l;h++){f=e[h].name;if(f.indexOf("data-")===0){f=f.substr(5);ka(this[0],f,d[f])}}}return d}else if(typeof a==="object")return this.each(function(){c.data(this,
a)});var k=a.split(".");k[1]=k[1]?"."+k[1]:"";if(b===B){d=this.triggerHandler("getData"+k[1]+"!",[k[0]]);if(d===B&&this.length){d=c.data(this[0],a);d=ka(this[0],a,d)}return d===B&&k[1]?this.data(k[0]):d}else return this.each(function(){var o=c(this),x=[k[0],b];o.triggerHandler("setData"+k[1]+"!",x);c.data(this,a,b);o.triggerHandler("changeData"+k[1]+"!",x)})},removeData:function(a){return this.each(function(){c.removeData(this,a)})}});c.extend({queue:function(a,b,d){if(a){b=(b||"fx")+"queue";var e=
c.data(a,b);if(!d)return e||[];if(!e||c.isArray(d))e=c.data(a,b,c.makeArray(d));else e.push(d);return e}},dequeue:function(a,b){b=b||"fx";var d=c.queue(a,b),e=d.shift();if(e==="inprogress")e=d.shift();if(e){b==="fx"&&d.unshift("inprogress");e.call(a,function(){c.dequeue(a,b)})}}});c.fn.extend({queue:function(a,b){if(typeof a!=="string"){b=a;a="fx"}if(b===B)return c.queue(this[0],a);return this.each(function(){var d=c.queue(this,a,b);a==="fx"&&d[0]!=="inprogress"&&c.dequeue(this,a)})},dequeue:function(a){return this.each(function(){c.dequeue(this,
a)})},delay:function(a,b){a=c.fx?c.fx.speeds[a]||a:a;b=b||"fx";return this.queue(b,function(){var d=this;setTimeout(function(){c.dequeue(d,b)},a)})},clearQueue:function(a){return this.queue(a||"fx",[])}});var sa=/[\n\t]/g,ha=/\s+/,Sa=/\r/g,Ta=/^(?:href|src|style)$/,Ua=/^(?:button|input)$/i,Va=/^(?:button|input|object|select|textarea)$/i,Wa=/^a(?:rea)?$/i,ta=/^(?:radio|checkbox)$/i;c.props={"for":"htmlFor","class":"className",readonly:"readOnly",maxlength:"maxLength",cellspacing:"cellSpacing",rowspan:"rowSpan",
colspan:"colSpan",tabindex:"tabIndex",usemap:"useMap",frameborder:"frameBorder"};c.fn.extend({attr:function(a,b){return c.access(this,a,b,true,c.attr)},removeAttr:function(a){return this.each(function(){c.attr(this,a,"");this.nodeType===1&&this.removeAttribute(a)})},addClass:function(a){if(c.isFunction(a))return this.each(function(x){var r=c(this);r.addClass(a.call(this,x,r.attr("class")))});if(a&&typeof a==="string")for(var b=(a||"").split(ha),d=0,e=this.length;d<e;d++){var f=this[d];if(f.nodeType===
1)if(f.className){for(var h=" "+f.className+" ",l=f.className,k=0,o=b.length;k<o;k++)if(h.indexOf(" "+b[k]+" ")<0)l+=" "+b[k];f.className=c.trim(l)}else f.className=a}return this},removeClass:function(a){if(c.isFunction(a))return this.each(function(o){var x=c(this);x.removeClass(a.call(this,o,x.attr("class")))});if(a&&typeof a==="string"||a===B)for(var b=(a||"").split(ha),d=0,e=this.length;d<e;d++){var f=this[d];if(f.nodeType===1&&f.className)if(a){for(var h=(" "+f.className+" ").replace(sa," "),
l=0,k=b.length;l<k;l++)h=h.replace(" "+b[l]+" "," ");f.className=c.trim(h)}else f.className=""}return this},toggleClass:function(a,b){var d=typeof a,e=typeof b==="boolean";if(c.isFunction(a))return this.each(function(f){var h=c(this);h.toggleClass(a.call(this,f,h.attr("class"),b),b)});return this.each(function(){if(d==="string")for(var f,h=0,l=c(this),k=b,o=a.split(ha);f=o[h++];){k=e?k:!l.hasClass(f);l[k?"addClass":"removeClass"](f)}else if(d==="undefined"||d==="boolean"){this.className&&c.data(this,
"__className__",this.className);this.className=this.className||a===false?"":c.data(this,"__className__")||""}})},hasClass:function(a){a=" "+a+" ";for(var b=0,d=this.length;b<d;b++)if((" "+this[b].className+" ").replace(sa," ").indexOf(a)>-1)return true;return false},val:function(a){if(!arguments.length){var b=this[0];if(b){if(c.nodeName(b,"option")){var d=b.attributes.value;return!d||d.specified?b.value:b.text}if(c.nodeName(b,"select")){var e=b.selectedIndex;d=[];var f=b.options;b=b.type==="select-one";
if(e<0)return null;var h=b?e:0;for(e=b?e+1:f.length;h<e;h++){var l=f[h];if(l.selected&&(c.support.optDisabled?!l.disabled:l.getAttribute("disabled")===null)&&(!l.parentNode.disabled||!c.nodeName(l.parentNode,"optgroup"))){a=c(l).val();if(b)return a;d.push(a)}}return d}if(ta.test(b.type)&&!c.support.checkOn)return b.getAttribute("value")===null?"on":b.value;return(b.value||"").replace(Sa,"")}return B}var k=c.isFunction(a);return this.each(function(o){var x=c(this),r=a;if(this.nodeType===1){if(k)r=
a.call(this,o,x.val());if(r==null)r="";else if(typeof r==="number")r+="";else if(c.isArray(r))r=c.map(r,function(C){return C==null?"":C+""});if(c.isArray(r)&&ta.test(this.type))this.checked=c.inArray(x.val(),r)>=0;else if(c.nodeName(this,"select")){var A=c.makeArray(r);c("option",this).each(function(){this.selected=c.inArray(c(this).val(),A)>=0});if(!A.length)this.selectedIndex=-1}else this.value=r}})}});c.extend({attrFn:{val:true,css:true,html:true,text:true,data:true,width:true,height:true,offset:true},
attr:function(a,b,d,e){if(!a||a.nodeType===3||a.nodeType===8)return B;if(e&&b in c.attrFn)return c(a)[b](d);e=a.nodeType!==1||!c.isXMLDoc(a);var f=d!==B;b=e&&c.props[b]||b;var h=Ta.test(b);if((b in a||a[b]!==B)&&e&&!h){if(f){b==="type"&&Ua.test(a.nodeName)&&a.parentNode&&c.error("type property can't be changed");if(d===null)a.nodeType===1&&a.removeAttribute(b);else a[b]=d}if(c.nodeName(a,"form")&&a.getAttributeNode(b))return a.getAttributeNode(b).nodeValue;if(b==="tabIndex")return(b=a.getAttributeNode("tabIndex"))&&
b.specified?b.value:Va.test(a.nodeName)||Wa.test(a.nodeName)&&a.href?0:B;return a[b]}if(!c.support.style&&e&&b==="style"){if(f)a.style.cssText=""+d;return a.style.cssText}f&&a.setAttribute(b,""+d);if(!a.attributes[b]&&a.hasAttribute&&!a.hasAttribute(b))return B;a=!c.support.hrefNormalized&&e&&h?a.getAttribute(b,2):a.getAttribute(b);return a===null?B:a}});var X=/\.(.*)$/,ia=/^(?:textarea|input|select)$/i,La=/\./g,Ma=/ /g,Xa=/[^\w\s.|`]/g,Ya=function(a){return a.replace(Xa,"\\$&")},ua={focusin:0,focusout:0};
c.event={add:function(a,b,d,e){if(!(a.nodeType===3||a.nodeType===8)){if(c.isWindow(a)&&a!==E&&!a.frameElement)a=E;if(d===false)d=U;else if(!d)return;var f,h;if(d.handler){f=d;d=f.handler}if(!d.guid)d.guid=c.guid++;if(h=c.data(a)){var l=a.nodeType?"events":"__events__",k=h[l],o=h.handle;if(typeof k==="function"){o=k.handle;k=k.events}else if(!k){a.nodeType||(h[l]=h=function(){});h.events=k={}}if(!o)h.handle=o=function(){return typeof c!=="undefined"&&!c.event.triggered?c.event.handle.apply(o.elem,
arguments):B};o.elem=a;b=b.split(" ");for(var x=0,r;l=b[x++];){h=f?c.extend({},f):{handler:d,data:e};if(l.indexOf(".")>-1){r=l.split(".");l=r.shift();h.namespace=r.slice(0).sort().join(".")}else{r=[];h.namespace=""}h.type=l;if(!h.guid)h.guid=d.guid;var A=k[l],C=c.event.special[l]||{};if(!A){A=k[l]=[];if(!C.setup||C.setup.call(a,e,r,o)===false)if(a.addEventListener)a.addEventListener(l,o,false);else a.attachEvent&&a.attachEvent("on"+l,o)}if(C.add){C.add.call(a,h);if(!h.handler.guid)h.handler.guid=
d.guid}A.push(h);c.event.global[l]=true}a=null}}},global:{},remove:function(a,b,d,e){if(!(a.nodeType===3||a.nodeType===8)){if(d===false)d=U;var f,h,l=0,k,o,x,r,A,C,J=a.nodeType?"events":"__events__",w=c.data(a),I=w&&w[J];if(w&&I){if(typeof I==="function"){w=I;I=I.events}if(b&&b.type){d=b.handler;b=b.type}if(!b||typeof b==="string"&&b.charAt(0)==="."){b=b||"";for(f in I)c.event.remove(a,f+b)}else{for(b=b.split(" ");f=b[l++];){r=f;k=f.indexOf(".")<0;o=[];if(!k){o=f.split(".");f=o.shift();x=RegExp("(^|\\.)"+
c.map(o.slice(0).sort(),Ya).join("\\.(?:.*\\.)?")+"(\\.|$)")}if(A=I[f])if(d){r=c.event.special[f]||{};for(h=e||0;h<A.length;h++){C=A[h];if(d.guid===C.guid){if(k||x.test(C.namespace)){e==null&&A.splice(h--,1);r.remove&&r.remove.call(a,C)}if(e!=null)break}}if(A.length===0||e!=null&&A.length===1){if(!r.teardown||r.teardown.call(a,o)===false)c.removeEvent(a,f,w.handle);delete I[f]}}else for(h=0;h<A.length;h++){C=A[h];if(k||x.test(C.namespace)){c.event.remove(a,r,C.handler,h);A.splice(h--,1)}}}if(c.isEmptyObject(I)){if(b=
w.handle)b.elem=null;delete w.events;delete w.handle;if(typeof w==="function")c.removeData(a,J);else c.isEmptyObject(w)&&c.removeData(a)}}}}},trigger:function(a,b,d,e){var f=a.type||a;if(!e){a=typeof a==="object"?a[c.expando]?a:c.extend(c.Event(f),a):c.Event(f);if(f.indexOf("!")>=0){a.type=f=f.slice(0,-1);a.exclusive=true}if(!d){a.stopPropagation();c.event.global[f]&&c.each(c.cache,function(){this.events&&this.events[f]&&c.event.trigger(a,b,this.handle.elem)})}if(!d||d.nodeType===3||d.nodeType===
8)return B;a.result=B;a.target=d;b=c.makeArray(b);b.unshift(a)}a.currentTarget=d;(e=d.nodeType?c.data(d,"handle"):(c.data(d,"__events__")||{}).handle)&&e.apply(d,b);e=d.parentNode||d.ownerDocument;try{if(!(d&&d.nodeName&&c.noData[d.nodeName.toLowerCase()]))if(d["on"+f]&&d["on"+f].apply(d,b)===false){a.result=false;a.preventDefault()}}catch(h){}if(!a.isPropagationStopped()&&e)c.event.trigger(a,b,e,true);else if(!a.isDefaultPrevented()){var l;e=a.target;var k=f.replace(X,""),o=c.nodeName(e,"a")&&k===
"click",x=c.event.special[k]||{};if((!x._default||x._default.call(d,a)===false)&&!o&&!(e&&e.nodeName&&c.noData[e.nodeName.toLowerCase()])){try{if(e[k]){if(l=e["on"+k])e["on"+k]=null;c.event.triggered=true;e[k]()}}catch(r){}if(l)e["on"+k]=l;c.event.triggered=false}}},handle:function(a){var b,d,e,f;d=[];var h=c.makeArray(arguments);a=h[0]=c.event.fix(a||E.event);a.currentTarget=this;b=a.type.indexOf(".")<0&&!a.exclusive;if(!b){e=a.type.split(".");a.type=e.shift();d=e.slice(0).sort();e=RegExp("(^|\\.)"+
d.join("\\.(?:.*\\.)?")+"(\\.|$)")}a.namespace=a.namespace||d.join(".");f=c.data(this,this.nodeType?"events":"__events__");if(typeof f==="function")f=f.events;d=(f||{})[a.type];if(f&&d){d=d.slice(0);f=0;for(var l=d.length;f<l;f++){var k=d[f];if(b||e.test(k.namespace)){a.handler=k.handler;a.data=k.data;a.handleObj=k;k=k.handler.apply(this,h);if(k!==B){a.result=k;if(k===false){a.preventDefault();a.stopPropagation()}}if(a.isImmediatePropagationStopped())break}}}return a.result},props:"altKey attrChange attrName bubbles button cancelable charCode clientX clientY ctrlKey currentTarget data detail eventPhase fromElement handler keyCode layerX layerY metaKey newValue offsetX offsetY pageX pageY prevValue relatedNode relatedTarget screenX screenY shiftKey srcElement target toElement view wheelDelta which".split(" "),
fix:function(a){if(a[c.expando])return a;var b=a;a=c.Event(b);for(var d=this.props.length,e;d;){e=this.props[--d];a[e]=b[e]}if(!a.target)a.target=a.srcElement||t;if(a.target.nodeType===3)a.target=a.target.parentNode;if(!a.relatedTarget&&a.fromElement)a.relatedTarget=a.fromElement===a.target?a.toElement:a.fromElement;if(a.pageX==null&&a.clientX!=null){b=t.documentElement;d=t.body;a.pageX=a.clientX+(b&&b.scrollLeft||d&&d.scrollLeft||0)-(b&&b.clientLeft||d&&d.clientLeft||0);a.pageY=a.clientY+(b&&b.scrollTop||
d&&d.scrollTop||0)-(b&&b.clientTop||d&&d.clientTop||0)}if(a.which==null&&(a.charCode!=null||a.keyCode!=null))a.which=a.charCode!=null?a.charCode:a.keyCode;if(!a.metaKey&&a.ctrlKey)a.metaKey=a.ctrlKey;if(!a.which&&a.button!==B)a.which=a.button&1?1:a.button&2?3:a.button&4?2:0;return a},guid:1E8,proxy:c.proxy,special:{ready:{setup:c.bindReady,teardown:c.noop},live:{add:function(a){c.event.add(this,Y(a.origType,a.selector),c.extend({},a,{handler:Ka,guid:a.handler.guid}))},remove:function(a){c.event.remove(this,
Y(a.origType,a.selector),a)}},beforeunload:{setup:function(a,b,d){if(c.isWindow(this))this.onbeforeunload=d},teardown:function(a,b){if(this.onbeforeunload===b)this.onbeforeunload=null}}}};c.removeEvent=t.removeEventListener?function(a,b,d){a.removeEventListener&&a.removeEventListener(b,d,false)}:function(a,b,d){a.detachEvent&&a.detachEvent("on"+b,d)};c.Event=function(a){if(!this.preventDefault)return new c.Event(a);if(a&&a.type){this.originalEvent=a;this.type=a.type}else this.type=a;this.timeStamp=
c.now();this[c.expando]=true};c.Event.prototype={preventDefault:function(){this.isDefaultPrevented=ca;var a=this.originalEvent;if(a)if(a.preventDefault)a.preventDefault();else a.returnValue=false},stopPropagation:function(){this.isPropagationStopped=ca;var a=this.originalEvent;if(a){a.stopPropagation&&a.stopPropagation();a.cancelBubble=true}},stopImmediatePropagation:function(){this.isImmediatePropagationStopped=ca;this.stopPropagation()},isDefaultPrevented:U,isPropagationStopped:U,isImmediatePropagationStopped:U};
var va=function(a){var b=a.relatedTarget;try{for(;b&&b!==this;)b=b.parentNode;if(b!==this){a.type=a.data;c.event.handle.apply(this,arguments)}}catch(d){}},wa=function(a){a.type=a.data;c.event.handle.apply(this,arguments)};c.each({mouseenter:"mouseover",mouseleave:"mouseout"},function(a,b){c.event.special[a]={setup:function(d){c.event.add(this,b,d&&d.selector?wa:va,a)},teardown:function(d){c.event.remove(this,b,d&&d.selector?wa:va)}}});if(!c.support.submitBubbles)c.event.special.submit={setup:function(){if(this.nodeName.toLowerCase()!==
"form"){c.event.add(this,"click.specialSubmit",function(a){var b=a.target,d=b.type;if((d==="submit"||d==="image")&&c(b).closest("form").length){a.liveFired=B;return la("submit",this,arguments)}});c.event.add(this,"keypress.specialSubmit",function(a){var b=a.target,d=b.type;if((d==="text"||d==="password")&&c(b).closest("form").length&&a.keyCode===13){a.liveFired=B;return la("submit",this,arguments)}})}else return false},teardown:function(){c.event.remove(this,".specialSubmit")}};if(!c.support.changeBubbles){var V,
xa=function(a){var b=a.type,d=a.value;if(b==="radio"||b==="checkbox")d=a.checked;else if(b==="select-multiple")d=a.selectedIndex>-1?c.map(a.options,function(e){return e.selected}).join("-"):"";else if(a.nodeName.toLowerCase()==="select")d=a.selectedIndex;return d},Z=function(a,b){var d=a.target,e,f;if(!(!ia.test(d.nodeName)||d.readOnly)){e=c.data(d,"_change_data");f=xa(d);if(a.type!=="focusout"||d.type!=="radio")c.data(d,"_change_data",f);if(!(e===B||f===e))if(e!=null||f){a.type="change";a.liveFired=
B;return c.event.trigger(a,b,d)}}};c.event.special.change={filters:{focusout:Z,beforedeactivate:Z,click:function(a){var b=a.target,d=b.type;if(d==="radio"||d==="checkbox"||b.nodeName.toLowerCase()==="select")return Z.call(this,a)},keydown:function(a){var b=a.target,d=b.type;if(a.keyCode===13&&b.nodeName.toLowerCase()!=="textarea"||a.keyCode===32&&(d==="checkbox"||d==="radio")||d==="select-multiple")return Z.call(this,a)},beforeactivate:function(a){a=a.target;c.data(a,"_change_data",xa(a))}},setup:function(){if(this.type===
"file")return false;for(var a in V)c.event.add(this,a+".specialChange",V[a]);return ia.test(this.nodeName)},teardown:function(){c.event.remove(this,".specialChange");return ia.test(this.nodeName)}};V=c.event.special.change.filters;V.focus=V.beforeactivate}t.addEventListener&&c.each({focus:"focusin",blur:"focusout"},function(a,b){function d(e){e=c.event.fix(e);e.type=b;return c.event.trigger(e,null,e.target)}c.event.special[b]={setup:function(){ua[b]++===0&&t.addEventListener(a,d,true)},teardown:function(){--ua[b]===
0&&t.removeEventListener(a,d,true)}}});c.each(["bind","one"],function(a,b){c.fn[b]=function(d,e,f){if(typeof d==="object"){for(var h in d)this[b](h,e,d[h],f);return this}if(c.isFunction(e)||e===false){f=e;e=B}var l=b==="one"?c.proxy(f,function(o){c(this).unbind(o,l);return f.apply(this,arguments)}):f;if(d==="unload"&&b!=="one")this.one(d,e,f);else{h=0;for(var k=this.length;h<k;h++)c.event.add(this[h],d,l,e)}return this}});c.fn.extend({unbind:function(a,b){if(typeof a==="object"&&!a.preventDefault)for(var d in a)this.unbind(d,
a[d]);else{d=0;for(var e=this.length;d<e;d++)c.event.remove(this[d],a,b)}return this},delegate:function(a,b,d,e){return this.live(b,d,e,a)},undelegate:function(a,b,d){return arguments.length===0?this.unbind("live"):this.die(b,null,d,a)},trigger:function(a,b){return this.each(function(){c.event.trigger(a,b,this)})},triggerHandler:function(a,b){if(this[0]){var d=c.Event(a);d.preventDefault();d.stopPropagation();c.event.trigger(d,b,this[0]);return d.result}},toggle:function(a){for(var b=arguments,d=
1;d<b.length;)c.proxy(a,b[d++]);return this.click(c.proxy(a,function(e){var f=(c.data(this,"lastToggle"+a.guid)||0)%d;c.data(this,"lastToggle"+a.guid,f+1);e.preventDefault();return b[f].apply(this,arguments)||false}))},hover:function(a,b){return this.mouseenter(a).mouseleave(b||a)}});var ya={focus:"focusin",blur:"focusout",mouseenter:"mouseover",mouseleave:"mouseout"};c.each(["live","die"],function(a,b){c.fn[b]=function(d,e,f,h){var l,k=0,o,x,r=h||this.selector;h=h?this:c(this.context);if(typeof d===
"object"&&!d.preventDefault){for(l in d)h[b](l,e,d[l],r);return this}if(c.isFunction(e)){f=e;e=B}for(d=(d||"").split(" ");(l=d[k++])!=null;){o=X.exec(l);x="";if(o){x=o[0];l=l.replace(X,"")}if(l==="hover")d.push("mouseenter"+x,"mouseleave"+x);else{o=l;if(l==="focus"||l==="blur"){d.push(ya[l]+x);l+=x}else l=(ya[l]||l)+x;if(b==="live"){x=0;for(var A=h.length;x<A;x++)c.event.add(h[x],"live."+Y(l,r),{data:e,selector:r,handler:f,origType:l,origHandler:f,preType:o})}else h.unbind("live."+Y(l,r),f)}}return this}});
c.each("blur focus focusin focusout load resize scroll unload click dblclick mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave change select submit keydown keypress keyup error".split(" "),function(a,b){c.fn[b]=function(d,e){if(e==null){e=d;d=null}return arguments.length>0?this.bind(b,d,e):this.trigger(b)};if(c.attrFn)c.attrFn[b]=true});E.attachEvent&&!E.addEventListener&&c(E).bind("unload",function(){for(var a in c.cache)if(c.cache[a].handle)try{c.event.remove(c.cache[a].handle.elem)}catch(b){}});
(function(){function a(g,i,n,m,p,q){p=0;for(var u=m.length;p<u;p++){var y=m[p];if(y){var F=false;for(y=y[g];y;){if(y.sizcache===n){F=m[y.sizset];break}if(y.nodeType===1&&!q){y.sizcache=n;y.sizset=p}if(y.nodeName.toLowerCase()===i){F=y;break}y=y[g]}m[p]=F}}}function b(g,i,n,m,p,q){p=0;for(var u=m.length;p<u;p++){var y=m[p];if(y){var F=false;for(y=y[g];y;){if(y.sizcache===n){F=m[y.sizset];break}if(y.nodeType===1){if(!q){y.sizcache=n;y.sizset=p}if(typeof i!=="string"){if(y===i){F=true;break}}else if(k.filter(i,
[y]).length>0){F=y;break}}y=y[g]}m[p]=F}}}var d=/((?:\((?:\([^()]+\)|[^()]+)+\)|\[(?:\[[^\[\]]*\]|['"][^'"]*['"]|[^\[\]'"]+)+\]|\\.|[^ >+~,(\[\\]+)+|[>+~])(\s*,\s*)?((?:.|\r|\n)*)/g,e=0,f=Object.prototype.toString,h=false,l=true;[0,0].sort(function(){l=false;return 0});var k=function(g,i,n,m){n=n||[];var p=i=i||t;if(i.nodeType!==1&&i.nodeType!==9)return[];if(!g||typeof g!=="string")return n;var q,u,y,F,M,N=true,O=k.isXML(i),D=[],R=g;do{d.exec("");if(q=d.exec(R)){R=q[3];D.push(q[1]);if(q[2]){F=q[3];
break}}}while(q);if(D.length>1&&x.exec(g))if(D.length===2&&o.relative[D[0]])u=L(D[0]+D[1],i);else for(u=o.relative[D[0]]?[i]:k(D.shift(),i);D.length;){g=D.shift();if(o.relative[g])g+=D.shift();u=L(g,u)}else{if(!m&&D.length>1&&i.nodeType===9&&!O&&o.match.ID.test(D[0])&&!o.match.ID.test(D[D.length-1])){q=k.find(D.shift(),i,O);i=q.expr?k.filter(q.expr,q.set)[0]:q.set[0]}if(i){q=m?{expr:D.pop(),set:C(m)}:k.find(D.pop(),D.length===1&&(D[0]==="~"||D[0]==="+")&&i.parentNode?i.parentNode:i,O);u=q.expr?k.filter(q.expr,
q.set):q.set;if(D.length>0)y=C(u);else N=false;for(;D.length;){q=M=D.pop();if(o.relative[M])q=D.pop();else M="";if(q==null)q=i;o.relative[M](y,q,O)}}else y=[]}y||(y=u);y||k.error(M||g);if(f.call(y)==="[object Array]")if(N)if(i&&i.nodeType===1)for(g=0;y[g]!=null;g++){if(y[g]&&(y[g]===true||y[g].nodeType===1&&k.contains(i,y[g])))n.push(u[g])}else for(g=0;y[g]!=null;g++)y[g]&&y[g].nodeType===1&&n.push(u[g]);else n.push.apply(n,y);else C(y,n);if(F){k(F,p,n,m);k.uniqueSort(n)}return n};k.uniqueSort=function(g){if(w){h=
l;g.sort(w);if(h)for(var i=1;i<g.length;i++)g[i]===g[i-1]&&g.splice(i--,1)}return g};k.matches=function(g,i){return k(g,null,null,i)};k.matchesSelector=function(g,i){return k(i,null,null,[g]).length>0};k.find=function(g,i,n){var m;if(!g)return[];for(var p=0,q=o.order.length;p<q;p++){var u,y=o.order[p];if(u=o.leftMatch[y].exec(g)){var F=u[1];u.splice(1,1);if(F.substr(F.length-1)!=="\\"){u[1]=(u[1]||"").replace(/\\/g,"");m=o.find[y](u,i,n);if(m!=null){g=g.replace(o.match[y],"");break}}}}m||(m=i.getElementsByTagName("*"));
return{set:m,expr:g}};k.filter=function(g,i,n,m){for(var p,q,u=g,y=[],F=i,M=i&&i[0]&&k.isXML(i[0]);g&&i.length;){for(var N in o.filter)if((p=o.leftMatch[N].exec(g))!=null&&p[2]){var O,D,R=o.filter[N];D=p[1];q=false;p.splice(1,1);if(D.substr(D.length-1)!=="\\"){if(F===y)y=[];if(o.preFilter[N])if(p=o.preFilter[N](p,F,n,y,m,M)){if(p===true)continue}else q=O=true;if(p)for(var j=0;(D=F[j])!=null;j++)if(D){O=R(D,p,j,F);var s=m^!!O;if(n&&O!=null)if(s)q=true;else F[j]=false;else if(s){y.push(D);q=true}}if(O!==
B){n||(F=y);g=g.replace(o.match[N],"");if(!q)return[];break}}}if(g===u)if(q==null)k.error(g);else break;u=g}return F};k.error=function(g){throw"Syntax error, unrecognized expression: "+g;};var o=k.selectors={order:["ID","NAME","TAG"],match:{ID:/#((?:[\w\u00c0-\uFFFF\-]|\\.)+)/,CLASS:/\.((?:[\w\u00c0-\uFFFF\-]|\\.)+)/,NAME:/\[name=['"]*((?:[\w\u00c0-\uFFFF\-]|\\.)+)['"]*\]/,ATTR:/\[\s*((?:[\w\u00c0-\uFFFF\-]|\\.)+)\s*(?:(\S?=)\s*(['"]*)(.*?)\3|)\s*\]/,TAG:/^((?:[\w\u00c0-\uFFFF\*\-]|\\.)+)/,CHILD:/:(only|nth|last|first)-child(?:\((even|odd|[\dn+\-]*)\))?/,
POS:/:(nth|eq|gt|lt|first|last|even|odd)(?:\((\d*)\))?(?=[^\-]|$)/,PSEUDO:/:((?:[\w\u00c0-\uFFFF\-]|\\.)+)(?:\((['"]?)((?:\([^\)]+\)|[^\(\)]*)+)\2\))?/},leftMatch:{},attrMap:{"class":"className","for":"htmlFor"},attrHandle:{href:function(g){return g.getAttribute("href")}},relative:{"+":function(g,i){var n=typeof i==="string",m=n&&!/\W/.test(i);n=n&&!m;if(m)i=i.toLowerCase();m=0;for(var p=g.length,q;m<p;m++)if(q=g[m]){for(;(q=q.previousSibling)&&q.nodeType!==1;);g[m]=n||q&&q.nodeName.toLowerCase()===
i?q||false:q===i}n&&k.filter(i,g,true)},">":function(g,i){var n,m=typeof i==="string",p=0,q=g.length;if(m&&!/\W/.test(i))for(i=i.toLowerCase();p<q;p++){if(n=g[p]){n=n.parentNode;g[p]=n.nodeName.toLowerCase()===i?n:false}}else{for(;p<q;p++)if(n=g[p])g[p]=m?n.parentNode:n.parentNode===i;m&&k.filter(i,g,true)}},"":function(g,i,n){var m,p=e++,q=b;if(typeof i==="string"&&!/\W/.test(i)){m=i=i.toLowerCase();q=a}q("parentNode",i,p,g,m,n)},"~":function(g,i,n){var m,p=e++,q=b;if(typeof i==="string"&&!/\W/.test(i)){m=
i=i.toLowerCase();q=a}q("previousSibling",i,p,g,m,n)}},find:{ID:function(g,i,n){if(typeof i.getElementById!=="undefined"&&!n)return(g=i.getElementById(g[1]))&&g.parentNode?[g]:[]},NAME:function(g,i){if(typeof i.getElementsByName!=="undefined"){for(var n=[],m=i.getElementsByName(g[1]),p=0,q=m.length;p<q;p++)m[p].getAttribute("name")===g[1]&&n.push(m[p]);return n.length===0?null:n}},TAG:function(g,i){return i.getElementsByTagName(g[1])}},preFilter:{CLASS:function(g,i,n,m,p,q){g=" "+g[1].replace(/\\/g,
"")+" ";if(q)return g;q=0;for(var u;(u=i[q])!=null;q++)if(u)if(p^(u.className&&(" "+u.className+" ").replace(/[\t\n]/g," ").indexOf(g)>=0))n||m.push(u);else if(n)i[q]=false;return false},ID:function(g){return g[1].replace(/\\/g,"")},TAG:function(g){return g[1].toLowerCase()},CHILD:function(g){if(g[1]==="nth"){var i=/(-?)(\d*)n((?:\+|-)?\d*)/.exec(g[2]==="even"&&"2n"||g[2]==="odd"&&"2n+1"||!/\D/.test(g[2])&&"0n+"+g[2]||g[2]);g[2]=i[1]+(i[2]||1)-0;g[3]=i[3]-0}g[0]=e++;return g},ATTR:function(g,i,n,
m,p,q){i=g[1].replace(/\\/g,"");if(!q&&o.attrMap[i])g[1]=o.attrMap[i];if(g[2]==="~=")g[4]=" "+g[4]+" ";return g},PSEUDO:function(g,i,n,m,p){if(g[1]==="not")if((d.exec(g[3])||"").length>1||/^\w/.test(g[3]))g[3]=k(g[3],null,null,i);else{g=k.filter(g[3],i,n,true^p);n||m.push.apply(m,g);return false}else if(o.match.POS.test(g[0])||o.match.CHILD.test(g[0]))return true;return g},POS:function(g){g.unshift(true);return g}},filters:{enabled:function(g){return g.disabled===false&&g.type!=="hidden"},disabled:function(g){return g.disabled===
true},checked:function(g){return g.checked===true},selected:function(g){return g.selected===true},parent:function(g){return!!g.firstChild},empty:function(g){return!g.firstChild},has:function(g,i,n){return!!k(n[3],g).length},header:function(g){return/h\d/i.test(g.nodeName)},text:function(g){return"text"===g.type},radio:function(g){return"radio"===g.type},checkbox:function(g){return"checkbox"===g.type},file:function(g){return"file"===g.type},password:function(g){return"password"===g.type},submit:function(g){return"submit"===
g.type},image:function(g){return"image"===g.type},reset:function(g){return"reset"===g.type},button:function(g){return"button"===g.type||g.nodeName.toLowerCase()==="button"},input:function(g){return/input|select|textarea|button/i.test(g.nodeName)}},setFilters:{first:function(g,i){return i===0},last:function(g,i,n,m){return i===m.length-1},even:function(g,i){return i%2===0},odd:function(g,i){return i%2===1},lt:function(g,i,n){return i<n[3]-0},gt:function(g,i,n){return i>n[3]-0},nth:function(g,i,n){return n[3]-
0===i},eq:function(g,i,n){return n[3]-0===i}},filter:{PSEUDO:function(g,i,n,m){var p=i[1],q=o.filters[p];if(q)return q(g,n,i,m);else if(p==="contains")return(g.textContent||g.innerText||k.getText([g])||"").indexOf(i[3])>=0;else if(p==="not"){i=i[3];n=0;for(m=i.length;n<m;n++)if(i[n]===g)return false;return true}else k.error("Syntax error, unrecognized expression: "+p)},CHILD:function(g,i){var n=i[1],m=g;switch(n){case "only":case "first":for(;m=m.previousSibling;)if(m.nodeType===1)return false;if(n===
"first")return true;m=g;case "last":for(;m=m.nextSibling;)if(m.nodeType===1)return false;return true;case "nth":n=i[2];var p=i[3];if(n===1&&p===0)return true;var q=i[0],u=g.parentNode;if(u&&(u.sizcache!==q||!g.nodeIndex)){var y=0;for(m=u.firstChild;m;m=m.nextSibling)if(m.nodeType===1)m.nodeIndex=++y;u.sizcache=q}m=g.nodeIndex-p;return n===0?m===0:m%n===0&&m/n>=0}},ID:function(g,i){return g.nodeType===1&&g.getAttribute("id")===i},TAG:function(g,i){return i==="*"&&g.nodeType===1||g.nodeName.toLowerCase()===
i},CLASS:function(g,i){return(" "+(g.className||g.getAttribute("class"))+" ").indexOf(i)>-1},ATTR:function(g,i){var n=i[1];n=o.attrHandle[n]?o.attrHandle[n](g):g[n]!=null?g[n]:g.getAttribute(n);var m=n+"",p=i[2],q=i[4];return n==null?p==="!=":p==="="?m===q:p==="*="?m.indexOf(q)>=0:p==="~="?(" "+m+" ").indexOf(q)>=0:!q?m&&n!==false:p==="!="?m!==q:p==="^="?m.indexOf(q)===0:p==="$="?m.substr(m.length-q.length)===q:p==="|="?m===q||m.substr(0,q.length+1)===q+"-":false},POS:function(g,i,n,m){var p=o.setFilters[i[2]];
if(p)return p(g,n,i,m)}}},x=o.match.POS,r=function(g,i){return"\\"+(i-0+1)},A;for(A in o.match){o.match[A]=RegExp(o.match[A].source+/(?![^\[]*\])(?![^\(]*\))/.source);o.leftMatch[A]=RegExp(/(^(?:.|\r|\n)*?)/.source+o.match[A].source.replace(/\\(\d+)/g,r))}var C=function(g,i){g=Array.prototype.slice.call(g,0);if(i){i.push.apply(i,g);return i}return g};try{Array.prototype.slice.call(t.documentElement.childNodes,0)}catch(J){C=function(g,i){var n=0,m=i||[];if(f.call(g)==="[object Array]")Array.prototype.push.apply(m,
g);else if(typeof g.length==="number")for(var p=g.length;n<p;n++)m.push(g[n]);else for(;g[n];n++)m.push(g[n]);return m}}var w,I;if(t.documentElement.compareDocumentPosition)w=function(g,i){if(g===i){h=true;return 0}if(!g.compareDocumentPosition||!i.compareDocumentPosition)return g.compareDocumentPosition?-1:1;return g.compareDocumentPosition(i)&4?-1:1};else{w=function(g,i){var n,m,p=[],q=[];n=g.parentNode;m=i.parentNode;var u=n;if(g===i){h=true;return 0}else if(n===m)return I(g,i);else if(n){if(!m)return 1}else return-1;
for(;u;){p.unshift(u);u=u.parentNode}for(u=m;u;){q.unshift(u);u=u.parentNode}n=p.length;m=q.length;for(u=0;u<n&&u<m;u++)if(p[u]!==q[u])return I(p[u],q[u]);return u===n?I(g,q[u],-1):I(p[u],i,1)};I=function(g,i,n){if(g===i)return n;for(g=g.nextSibling;g;){if(g===i)return-1;g=g.nextSibling}return 1}}k.getText=function(g){for(var i="",n,m=0;g[m];m++){n=g[m];if(n.nodeType===3||n.nodeType===4)i+=n.nodeValue;else if(n.nodeType!==8)i+=k.getText(n.childNodes)}return i};(function(){var g=t.createElement("div"),
i="script"+(new Date).getTime(),n=t.documentElement;g.innerHTML="<a name='"+i+"'/>";n.insertBefore(g,n.firstChild);if(t.getElementById(i)){o.find.ID=function(m,p,q){if(typeof p.getElementById!=="undefined"&&!q)return(p=p.getElementById(m[1]))?p.id===m[1]||typeof p.getAttributeNode!=="undefined"&&p.getAttributeNode("id").nodeValue===m[1]?[p]:B:[]};o.filter.ID=function(m,p){var q=typeof m.getAttributeNode!=="undefined"&&m.getAttributeNode("id");return m.nodeType===1&&q&&q.nodeValue===p}}n.removeChild(g);
n=g=null})();(function(){var g=t.createElement("div");g.appendChild(t.createComment(""));if(g.getElementsByTagName("*").length>0)o.find.TAG=function(i,n){var m=n.getElementsByTagName(i[1]);if(i[1]==="*"){for(var p=[],q=0;m[q];q++)m[q].nodeType===1&&p.push(m[q]);m=p}return m};g.innerHTML="<a href='#'></a>";if(g.firstChild&&typeof g.firstChild.getAttribute!=="undefined"&&g.firstChild.getAttribute("href")!=="#")o.attrHandle.href=function(i){return i.getAttribute("href",2)};g=null})();t.querySelectorAll&&
function(){var g=k,i=t.createElement("div");i.innerHTML="<p class='TEST'></p>";if(!(i.querySelectorAll&&i.querySelectorAll(".TEST").length===0)){k=function(m,p,q,u){p=p||t;m=m.replace(/\=\s*([^'"\]]*)\s*\]/g,"='$1']");if(!u&&!k.isXML(p))if(p.nodeType===9)try{return C(p.querySelectorAll(m),q)}catch(y){}else if(p.nodeType===1&&p.nodeName.toLowerCase()!=="object"){var F=p.getAttribute("id"),M=F||"__sizzle__";F||p.setAttribute("id",M);try{return C(p.querySelectorAll("#"+M+" "+m),q)}catch(N){}finally{F||
p.removeAttribute("id")}}return g(m,p,q,u)};for(var n in g)k[n]=g[n];i=null}}();(function(){var g=t.documentElement,i=g.matchesSelector||g.mozMatchesSelector||g.webkitMatchesSelector||g.msMatchesSelector,n=false;try{i.call(t.documentElement,"[test!='']:sizzle")}catch(m){n=true}if(i)k.matchesSelector=function(p,q){q=q.replace(/\=\s*([^'"\]]*)\s*\]/g,"='$1']");if(!k.isXML(p))try{if(n||!o.match.PSEUDO.test(q)&&!/!=/.test(q))return i.call(p,q)}catch(u){}return k(q,null,null,[p]).length>0}})();(function(){var g=
t.createElement("div");g.innerHTML="<div class='test e'></div><div class='test'></div>";if(!(!g.getElementsByClassName||g.getElementsByClassName("e").length===0)){g.lastChild.className="e";if(g.getElementsByClassName("e").length!==1){o.order.splice(1,0,"CLASS");o.find.CLASS=function(i,n,m){if(typeof n.getElementsByClassName!=="undefined"&&!m)return n.getElementsByClassName(i[1])};g=null}}})();k.contains=t.documentElement.contains?function(g,i){return g!==i&&(g.contains?g.contains(i):true)}:t.documentElement.compareDocumentPosition?
function(g,i){return!!(g.compareDocumentPosition(i)&16)}:function(){return false};k.isXML=function(g){return(g=(g?g.ownerDocument||g:0).documentElement)?g.nodeName!=="HTML":false};var L=function(g,i){for(var n,m=[],p="",q=i.nodeType?[i]:i;n=o.match.PSEUDO.exec(g);){p+=n[0];g=g.replace(o.match.PSEUDO,"")}g=o.relative[g]?g+"*":g;n=0;for(var u=q.length;n<u;n++)k(g,q[n],m);return k.filter(p,m)};c.find=k;c.expr=k.selectors;c.expr[":"]=c.expr.filters;c.unique=k.uniqueSort;c.text=k.getText;c.isXMLDoc=k.isXML;
c.contains=k.contains})();var Za=/Until$/,$a=/^(?:parents|prevUntil|prevAll)/,ab=/,/,Na=/^.[^:#\[\.,]*$/,bb=Array.prototype.slice,cb=c.expr.match.POS;c.fn.extend({find:function(a){for(var b=this.pushStack("","find",a),d=0,e=0,f=this.length;e<f;e++){d=b.length;c.find(a,this[e],b);if(e>0)for(var h=d;h<b.length;h++)for(var l=0;l<d;l++)if(b[l]===b[h]){b.splice(h--,1);break}}return b},has:function(a){var b=c(a);return this.filter(function(){for(var d=0,e=b.length;d<e;d++)if(c.contains(this,b[d]))return true})},
not:function(a){return this.pushStack(ma(this,a,false),"not",a)},filter:function(a){return this.pushStack(ma(this,a,true),"filter",a)},is:function(a){return!!a&&c.filter(a,this).length>0},closest:function(a,b){var d=[],e,f,h=this[0];if(c.isArray(a)){var l,k={},o=1;if(h&&a.length){e=0;for(f=a.length;e<f;e++){l=a[e];k[l]||(k[l]=c.expr.match.POS.test(l)?c(l,b||this.context):l)}for(;h&&h.ownerDocument&&h!==b;){for(l in k){e=k[l];if(e.jquery?e.index(h)>-1:c(h).is(e))d.push({selector:l,elem:h,level:o})}h=
h.parentNode;o++}}return d}l=cb.test(a)?c(a,b||this.context):null;e=0;for(f=this.length;e<f;e++)for(h=this[e];h;)if(l?l.index(h)>-1:c.find.matchesSelector(h,a)){d.push(h);break}else{h=h.parentNode;if(!h||!h.ownerDocument||h===b)break}d=d.length>1?c.unique(d):d;return this.pushStack(d,"closest",a)},index:function(a){if(!a||typeof a==="string")return c.inArray(this[0],a?c(a):this.parent().children());return c.inArray(a.jquery?a[0]:a,this)},add:function(a,b){var d=typeof a==="string"?c(a,b||this.context):
c.makeArray(a),e=c.merge(this.get(),d);return this.pushStack(!d[0]||!d[0].parentNode||d[0].parentNode.nodeType===11||!e[0]||!e[0].parentNode||e[0].parentNode.nodeType===11?e:c.unique(e))},andSelf:function(){return this.add(this.prevObject)}});c.each({parent:function(a){return(a=a.parentNode)&&a.nodeType!==11?a:null},parents:function(a){return c.dir(a,"parentNode")},parentsUntil:function(a,b,d){return c.dir(a,"parentNode",d)},next:function(a){return c.nth(a,2,"nextSibling")},prev:function(a){return c.nth(a,
2,"previousSibling")},nextAll:function(a){return c.dir(a,"nextSibling")},prevAll:function(a){return c.dir(a,"previousSibling")},nextUntil:function(a,b,d){return c.dir(a,"nextSibling",d)},prevUntil:function(a,b,d){return c.dir(a,"previousSibling",d)},siblings:function(a){return c.sibling(a.parentNode.firstChild,a)},children:function(a){return c.sibling(a.firstChild)},contents:function(a){return c.nodeName(a,"iframe")?a.contentDocument||a.contentWindow.document:c.makeArray(a.childNodes)}},function(a,
b){c.fn[a]=function(d,e){var f=c.map(this,b,d);Za.test(a)||(e=d);if(e&&typeof e==="string")f=c.filter(e,f);f=this.length>1?c.unique(f):f;if((this.length>1||ab.test(e))&&$a.test(a))f=f.reverse();return this.pushStack(f,a,bb.call(arguments).join(","))}});c.extend({filter:function(a,b,d){if(d)a=":not("+a+")";return b.length===1?c.find.matchesSelector(b[0],a)?[b[0]]:[]:c.find.matches(a,b)},dir:function(a,b,d){var e=[];for(a=a[b];a&&a.nodeType!==9&&(d===B||a.nodeType!==1||!c(a).is(d));){a.nodeType===1&&
e.push(a);a=a[b]}return e},nth:function(a,b,d){b=b||1;for(var e=0;a;a=a[d])if(a.nodeType===1&&++e===b)break;return a},sibling:function(a,b){for(var d=[];a;a=a.nextSibling)a.nodeType===1&&a!==b&&d.push(a);return d}});var za=/ jQuery\d+="(?:\d+|null)"/g,$=/^\s+/,Aa=/<(?!area|br|col|embed|hr|img|input|link|meta|param)(([\w:]+)[^>]*)\/>/ig,Ba=/<([\w:]+)/,db=/<tbody/i,eb=/<|&#?\w+;/,Ca=/<(?:script|object|embed|option|style)/i,Da=/checked\s*(?:[^=]|=\s*.checked.)/i,fb=/\=([^="'>\s]+\/)>/g,P={option:[1,
"<select multiple='multiple'>","</select>"],legend:[1,"<fieldset>","</fieldset>"],thead:[1,"<table>","</table>"],tr:[2,"<table><tbody>","</tbody></table>"],td:[3,"<table><tbody><tr>","</tr></tbody></table>"],col:[2,"<table><tbody></tbody><colgroup>","</colgroup></table>"],area:[1,"<map>","</map>"],_default:[0,"",""]};P.optgroup=P.option;P.tbody=P.tfoot=P.colgroup=P.caption=P.thead;P.th=P.td;if(!c.support.htmlSerialize)P._default=[1,"div<div>","</div>"];c.fn.extend({text:function(a){if(c.isFunction(a))return this.each(function(b){var d=
c(this);d.text(a.call(this,b,d.text()))});if(typeof a!=="object"&&a!==B)return this.empty().append((this[0]&&this[0].ownerDocument||t).createTextNode(a));return c.text(this)},wrapAll:function(a){if(c.isFunction(a))return this.each(function(d){c(this).wrapAll(a.call(this,d))});if(this[0]){var b=c(a,this[0].ownerDocument).eq(0).clone(true);this[0].parentNode&&b.insertBefore(this[0]);b.map(function(){for(var d=this;d.firstChild&&d.firstChild.nodeType===1;)d=d.firstChild;return d}).append(this)}return this},
wrapInner:function(a){if(c.isFunction(a))return this.each(function(b){c(this).wrapInner(a.call(this,b))});return this.each(function(){var b=c(this),d=b.contents();d.length?d.wrapAll(a):b.append(a)})},wrap:function(a){return this.each(function(){c(this).wrapAll(a)})},unwrap:function(){return this.parent().each(function(){c.nodeName(this,"body")||c(this).replaceWith(this.childNodes)}).end()},append:function(){return this.domManip(arguments,true,function(a){this.nodeType===1&&this.appendChild(a)})},
prepend:function(){return this.domManip(arguments,true,function(a){this.nodeType===1&&this.insertBefore(a,this.firstChild)})},before:function(){if(this[0]&&this[0].parentNode)return this.domManip(arguments,false,function(b){this.parentNode.insertBefore(b,this)});else if(arguments.length){var a=c(arguments[0]);a.push.apply(a,this.toArray());return this.pushStack(a,"before",arguments)}},after:function(){if(this[0]&&this[0].parentNode)return this.domManip(arguments,false,function(b){this.parentNode.insertBefore(b,
this.nextSibling)});else if(arguments.length){var a=this.pushStack(this,"after",arguments);a.push.apply(a,c(arguments[0]).toArray());return a}},remove:function(a,b){for(var d=0,e;(e=this[d])!=null;d++)if(!a||c.filter(a,[e]).length){if(!b&&e.nodeType===1){c.cleanData(e.getElementsByTagName("*"));c.cleanData([e])}e.parentNode&&e.parentNode.removeChild(e)}return this},empty:function(){for(var a=0,b;(b=this[a])!=null;a++)for(b.nodeType===1&&c.cleanData(b.getElementsByTagName("*"));b.firstChild;)b.removeChild(b.firstChild);
return this},clone:function(a){var b=this.map(function(){if(!c.support.noCloneEvent&&!c.isXMLDoc(this)){var d=this.outerHTML,e=this.ownerDocument;if(!d){d=e.createElement("div");d.appendChild(this.cloneNode(true));d=d.innerHTML}return c.clean([d.replace(za,"").replace(fb,'="$1">').replace($,"")],e)[0]}else return this.cloneNode(true)});if(a===true){na(this,b);na(this.find("*"),b.find("*"))}return b},html:function(a){if(a===B)return this[0]&&this[0].nodeType===1?this[0].innerHTML.replace(za,""):null;
else if(typeof a==="string"&&!Ca.test(a)&&(c.support.leadingWhitespace||!$.test(a))&&!P[(Ba.exec(a)||["",""])[1].toLowerCase()]){a=a.replace(Aa,"<$1></$2>");try{for(var b=0,d=this.length;b<d;b++)if(this[b].nodeType===1){c.cleanData(this[b].getElementsByTagName("*"));this[b].innerHTML=a}}catch(e){this.empty().append(a)}}else c.isFunction(a)?this.each(function(f){var h=c(this);h.html(a.call(this,f,h.html()))}):this.empty().append(a);return this},replaceWith:function(a){if(this[0]&&this[0].parentNode){if(c.isFunction(a))return this.each(function(b){var d=
c(this),e=d.html();d.replaceWith(a.call(this,b,e))});if(typeof a!=="string")a=c(a).detach();return this.each(function(){var b=this.nextSibling,d=this.parentNode;c(this).remove();b?c(b).before(a):c(d).append(a)})}else return this.pushStack(c(c.isFunction(a)?a():a),"replaceWith",a)},detach:function(a){return this.remove(a,true)},domManip:function(a,b,d){var e,f,h,l=a[0],k=[];if(!c.support.checkClone&&arguments.length===3&&typeof l==="string"&&Da.test(l))return this.each(function(){c(this).domManip(a,
b,d,true)});if(c.isFunction(l))return this.each(function(x){var r=c(this);a[0]=l.call(this,x,b?r.html():B);r.domManip(a,b,d)});if(this[0]){e=l&&l.parentNode;e=c.support.parentNode&&e&&e.nodeType===11&&e.childNodes.length===this.length?{fragment:e}:c.buildFragment(a,this,k);h=e.fragment;if(f=h.childNodes.length===1?h=h.firstChild:h.firstChild){b=b&&c.nodeName(f,"tr");f=0;for(var o=this.length;f<o;f++)d.call(b?c.nodeName(this[f],"table")?this[f].getElementsByTagName("tbody")[0]||this[f].appendChild(this[f].ownerDocument.createElement("tbody")):
this[f]:this[f],f>0||e.cacheable||this.length>1?h.cloneNode(true):h)}k.length&&c.each(k,Oa)}return this}});c.buildFragment=function(a,b,d){var e,f,h;b=b&&b[0]?b[0].ownerDocument||b[0]:t;if(a.length===1&&typeof a[0]==="string"&&a[0].length<512&&b===t&&!Ca.test(a[0])&&(c.support.checkClone||!Da.test(a[0]))){f=true;if(h=c.fragments[a[0]])if(h!==1)e=h}if(!e){e=b.createDocumentFragment();c.clean(a,b,e,d)}if(f)c.fragments[a[0]]=h?e:1;return{fragment:e,cacheable:f}};c.fragments={};c.each({appendTo:"append",
prependTo:"prepend",insertBefore:"before",insertAfter:"after",replaceAll:"replaceWith"},function(a,b){c.fn[a]=function(d){var e=[];d=c(d);var f=this.length===1&&this[0].parentNode;if(f&&f.nodeType===11&&f.childNodes.length===1&&d.length===1){d[b](this[0]);return this}else{f=0;for(var h=d.length;f<h;f++){var l=(f>0?this.clone(true):this).get();c(d[f])[b](l);e=e.concat(l)}return this.pushStack(e,a,d.selector)}}});c.extend({clean:function(a,b,d,e){b=b||t;if(typeof b.createElement==="undefined")b=b.ownerDocument||
b[0]&&b[0].ownerDocument||t;for(var f=[],h=0,l;(l=a[h])!=null;h++){if(typeof l==="number")l+="";if(l){if(typeof l==="string"&&!eb.test(l))l=b.createTextNode(l);else if(typeof l==="string"){l=l.replace(Aa,"<$1></$2>");var k=(Ba.exec(l)||["",""])[1].toLowerCase(),o=P[k]||P._default,x=o[0],r=b.createElement("div");for(r.innerHTML=o[1]+l+o[2];x--;)r=r.lastChild;if(!c.support.tbody){x=db.test(l);k=k==="table"&&!x?r.firstChild&&r.firstChild.childNodes:o[1]==="<table>"&&!x?r.childNodes:[];for(o=k.length-
1;o>=0;--o)c.nodeName(k[o],"tbody")&&!k[o].childNodes.length&&k[o].parentNode.removeChild(k[o])}!c.support.leadingWhitespace&&$.test(l)&&r.insertBefore(b.createTextNode($.exec(l)[0]),r.firstChild);l=r.childNodes}if(l.nodeType)f.push(l);else f=c.merge(f,l)}}if(d)for(h=0;f[h];h++)if(e&&c.nodeName(f[h],"script")&&(!f[h].type||f[h].type.toLowerCase()==="text/javascript"))e.push(f[h].parentNode?f[h].parentNode.removeChild(f[h]):f[h]);else{f[h].nodeType===1&&f.splice.apply(f,[h+1,0].concat(c.makeArray(f[h].getElementsByTagName("script"))));
d.appendChild(f[h])}return f},cleanData:function(a){for(var b,d,e=c.cache,f=c.event.special,h=c.support.deleteExpando,l=0,k;(k=a[l])!=null;l++)if(!(k.nodeName&&c.noData[k.nodeName.toLowerCase()]))if(d=k[c.expando]){if((b=e[d])&&b.events)for(var o in b.events)f[o]?c.event.remove(k,o):c.removeEvent(k,o,b.handle);if(h)delete k[c.expando];else k.removeAttribute&&k.removeAttribute(c.expando);delete e[d]}}});var Ea=/alpha\([^)]*\)/i,gb=/opacity=([^)]*)/,hb=/-([a-z])/ig,ib=/([A-Z])/g,Fa=/^-?\d+(?:px)?$/i,
jb=/^-?\d/,kb={position:"absolute",visibility:"hidden",display:"block"},Pa=["Left","Right"],Qa=["Top","Bottom"],W,Ga,aa,lb=function(a,b){return b.toUpperCase()};c.fn.css=function(a,b){if(arguments.length===2&&b===B)return this;return c.access(this,a,b,true,function(d,e,f){return f!==B?c.style(d,e,f):c.css(d,e)})};c.extend({cssHooks:{opacity:{get:function(a,b){if(b){var d=W(a,"opacity","opacity");return d===""?"1":d}else return a.style.opacity}}},cssNumber:{zIndex:true,fontWeight:true,opacity:true,
zoom:true,lineHeight:true},cssProps:{"float":c.support.cssFloat?"cssFloat":"styleFloat"},style:function(a,b,d,e){if(!(!a||a.nodeType===3||a.nodeType===8||!a.style)){var f,h=c.camelCase(b),l=a.style,k=c.cssHooks[h];b=c.cssProps[h]||h;if(d!==B){if(!(typeof d==="number"&&isNaN(d)||d==null)){if(typeof d==="number"&&!c.cssNumber[h])d+="px";if(!k||!("set"in k)||(d=k.set(a,d))!==B)try{l[b]=d}catch(o){}}}else{if(k&&"get"in k&&(f=k.get(a,false,e))!==B)return f;return l[b]}}},css:function(a,b,d){var e,f=c.camelCase(b),
h=c.cssHooks[f];b=c.cssProps[f]||f;if(h&&"get"in h&&(e=h.get(a,true,d))!==B)return e;else if(W)return W(a,b,f)},swap:function(a,b,d){var e={},f;for(f in b){e[f]=a.style[f];a.style[f]=b[f]}d.call(a);for(f in b)a.style[f]=e[f]},camelCase:function(a){return a.replace(hb,lb)}});c.curCSS=c.css;c.each(["height","width"],function(a,b){c.cssHooks[b]={get:function(d,e,f){var h;if(e){if(d.offsetWidth!==0)h=oa(d,b,f);else c.swap(d,kb,function(){h=oa(d,b,f)});if(h<=0){h=W(d,b,b);if(h==="0px"&&aa)h=aa(d,b,b);
if(h!=null)return h===""||h==="auto"?"0px":h}if(h<0||h==null){h=d.style[b];return h===""||h==="auto"?"0px":h}return typeof h==="string"?h:h+"px"}},set:function(d,e){if(Fa.test(e)){e=parseFloat(e);if(e>=0)return e+"px"}else return e}}});if(!c.support.opacity)c.cssHooks.opacity={get:function(a,b){return gb.test((b&&a.currentStyle?a.currentStyle.filter:a.style.filter)||"")?parseFloat(RegExp.$1)/100+"":b?"1":""},set:function(a,b){var d=a.style;d.zoom=1;var e=c.isNaN(b)?"":"alpha(opacity="+b*100+")",f=
d.filter||"";d.filter=Ea.test(f)?f.replace(Ea,e):d.filter+" "+e}};if(t.defaultView&&t.defaultView.getComputedStyle)Ga=function(a,b,d){var e;d=d.replace(ib,"-$1").toLowerCase();if(!(b=a.ownerDocument.defaultView))return B;if(b=b.getComputedStyle(a,null)){e=b.getPropertyValue(d);if(e===""&&!c.contains(a.ownerDocument.documentElement,a))e=c.style(a,d)}return e};if(t.documentElement.currentStyle)aa=function(a,b){var d,e,f=a.currentStyle&&a.currentStyle[b],h=a.style;if(!Fa.test(f)&&jb.test(f)){d=h.left;
e=a.runtimeStyle.left;a.runtimeStyle.left=a.currentStyle.left;h.left=b==="fontSize"?"1em":f||0;f=h.pixelLeft+"px";h.left=d;a.runtimeStyle.left=e}return f===""?"auto":f};W=Ga||aa;if(c.expr&&c.expr.filters){c.expr.filters.hidden=function(a){var b=a.offsetHeight;return a.offsetWidth===0&&b===0||!c.support.reliableHiddenOffsets&&(a.style.display||c.css(a,"display"))==="none"};c.expr.filters.visible=function(a){return!c.expr.filters.hidden(a)}}var mb=c.now(),nb=/<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/gi,
ob=/^(?:select|textarea)/i,pb=/^(?:color|date|datetime|email|hidden|month|number|password|range|search|tel|text|time|url|week)$/i,qb=/^(?:GET|HEAD)$/,Ra=/\[\]$/,T=/\=\?(&|$)/,ja=/\?/,rb=/([?&])_=[^&]*/,sb=/^(\w+:)?\/\/([^\/?#]+)/,tb=/%20/g,ub=/#.*$/,Ha=c.fn.load;c.fn.extend({load:function(a,b,d){if(typeof a!=="string"&&Ha)return Ha.apply(this,arguments);else if(!this.length)return this;var e=a.indexOf(" ");if(e>=0){var f=a.slice(e,a.length);a=a.slice(0,e)}e="GET";if(b)if(c.isFunction(b)){d=b;b=null}else if(typeof b===
"object"){b=c.param(b,c.ajaxSettings.traditional);e="POST"}var h=this;c.ajax({url:a,type:e,dataType:"html",data:b,complete:function(l,k){if(k==="success"||k==="notmodified")h.html(f?c("<div>").append(l.responseText.replace(nb,"")).find(f):l.responseText);d&&h.each(d,[l.responseText,k,l])}});return this},serialize:function(){return c.param(this.serializeArray())},serializeArray:function(){return this.map(function(){return this.elements?c.makeArray(this.elements):this}).filter(function(){return this.name&&
!this.disabled&&(this.checked||ob.test(this.nodeName)||pb.test(this.type))}).map(function(a,b){var d=c(this).val();return d==null?null:c.isArray(d)?c.map(d,function(e){return{name:b.name,value:e}}):{name:b.name,value:d}}).get()}});c.each("ajaxStart ajaxStop ajaxComplete ajaxError ajaxSuccess ajaxSend".split(" "),function(a,b){c.fn[b]=function(d){return this.bind(b,d)}});c.extend({get:function(a,b,d,e){if(c.isFunction(b)){e=e||d;d=b;b=null}return c.ajax({type:"GET",url:a,data:b,success:d,dataType:e})},
getScript:function(a,b){return c.get(a,null,b,"script")},getJSON:function(a,b,d){return c.get(a,b,d,"json")},post:function(a,b,d,e){if(c.isFunction(b)){e=e||d;d=b;b={}}return c.ajax({type:"POST",url:a,data:b,success:d,dataType:e})},ajaxSetup:function(a){c.extend(c.ajaxSettings,a)},ajaxSettings:{url:location.href,global:true,type:"GET",contentType:"application/x-www-form-urlencoded",processData:true,async:true,xhr:function(){return new E.XMLHttpRequest},accepts:{xml:"application/xml, text/xml",html:"text/html",
script:"text/javascript, application/javascript",json:"application/json, text/javascript",text:"text/plain",_default:"*/*"}},ajax:function(a){var b=c.extend(true,{},c.ajaxSettings,a),d,e,f,h=b.type.toUpperCase(),l=qb.test(h);b.url=b.url.replace(ub,"");b.context=a&&a.context!=null?a.context:b;if(b.data&&b.processData&&typeof b.data!=="string")b.data=c.param(b.data,b.traditional);if(b.dataType==="jsonp"){if(h==="GET")T.test(b.url)||(b.url+=(ja.test(b.url)?"&":"?")+(b.jsonp||"callback")+"=?");else if(!b.data||
!T.test(b.data))b.data=(b.data?b.data+"&":"")+(b.jsonp||"callback")+"=?";b.dataType="json"}if(b.dataType==="json"&&(b.data&&T.test(b.data)||T.test(b.url))){d=b.jsonpCallback||"jsonp"+mb++;if(b.data)b.data=(b.data+"").replace(T,"="+d+"$1");b.url=b.url.replace(T,"="+d+"$1");b.dataType="script";var k=E[d];E[d]=function(m){if(c.isFunction(k))k(m);else{E[d]=B;try{delete E[d]}catch(p){}}f=m;c.handleSuccess(b,w,e,f);c.handleComplete(b,w,e,f);r&&r.removeChild(A)}}if(b.dataType==="script"&&b.cache===null)b.cache=
false;if(b.cache===false&&l){var o=c.now(),x=b.url.replace(rb,"$1_="+o);b.url=x+(x===b.url?(ja.test(b.url)?"&":"?")+"_="+o:"")}if(b.data&&l)b.url+=(ja.test(b.url)?"&":"?")+b.data;b.global&&c.active++===0&&c.event.trigger("ajaxStart");o=(o=sb.exec(b.url))&&(o[1]&&o[1].toLowerCase()!==location.protocol||o[2].toLowerCase()!==location.host);if(b.dataType==="script"&&h==="GET"&&o){var r=t.getElementsByTagName("head")[0]||t.documentElement,A=t.createElement("script");if(b.scriptCharset)A.charset=b.scriptCharset;
A.src=b.url;if(!d){var C=false;A.onload=A.onreadystatechange=function(){if(!C&&(!this.readyState||this.readyState==="loaded"||this.readyState==="complete")){C=true;c.handleSuccess(b,w,e,f);c.handleComplete(b,w,e,f);A.onload=A.onreadystatechange=null;r&&A.parentNode&&r.removeChild(A)}}}r.insertBefore(A,r.firstChild);return B}var J=false,w=b.xhr();if(w){b.username?w.open(h,b.url,b.async,b.username,b.password):w.open(h,b.url,b.async);try{if(b.data!=null&&!l||a&&a.contentType)w.setRequestHeader("Content-Type",
b.contentType);if(b.ifModified){c.lastModified[b.url]&&w.setRequestHeader("If-Modified-Since",c.lastModified[b.url]);c.etag[b.url]&&w.setRequestHeader("If-None-Match",c.etag[b.url])}o||w.setRequestHeader("X-Requested-With","XMLHttpRequest");w.setRequestHeader("Accept",b.dataType&&b.accepts[b.dataType]?b.accepts[b.dataType]+", */*; q=0.01":b.accepts._default)}catch(I){}if(b.beforeSend&&b.beforeSend.call(b.context,w,b)===false){b.global&&c.active--===1&&c.event.trigger("ajaxStop");w.abort();return false}b.global&&
c.triggerGlobal(b,"ajaxSend",[w,b]);var L=w.onreadystatechange=function(m){if(!w||w.readyState===0||m==="abort"){J||c.handleComplete(b,w,e,f);J=true;if(w)w.onreadystatechange=c.noop}else if(!J&&w&&(w.readyState===4||m==="timeout")){J=true;w.onreadystatechange=c.noop;e=m==="timeout"?"timeout":!c.httpSuccess(w)?"error":b.ifModified&&c.httpNotModified(w,b.url)?"notmodified":"success";var p;if(e==="success")try{f=c.httpData(w,b.dataType,b)}catch(q){e="parsererror";p=q}if(e==="success"||e==="notmodified")d||
c.handleSuccess(b,w,e,f);else c.handleError(b,w,e,p);d||c.handleComplete(b,w,e,f);m==="timeout"&&w.abort();if(b.async)w=null}};try{var g=w.abort;w.abort=function(){w&&Function.prototype.call.call(g,w);L("abort")}}catch(i){}b.async&&b.timeout>0&&setTimeout(function(){w&&!J&&L("timeout")},b.timeout);try{w.send(l||b.data==null?null:b.data)}catch(n){c.handleError(b,w,null,n);c.handleComplete(b,w,e,f)}b.async||L();return w}},param:function(a,b){var d=[],e=function(h,l){l=c.isFunction(l)?l():l;d[d.length]=
encodeURIComponent(h)+"="+encodeURIComponent(l)};if(b===B)b=c.ajaxSettings.traditional;if(c.isArray(a)||a.jquery)c.each(a,function(){e(this.name,this.value)});else for(var f in a)da(f,a[f],b,e);return d.join("&").replace(tb,"+")}});c.extend({active:0,lastModified:{},etag:{},handleError:function(a,b,d,e){a.error&&a.error.call(a.context,b,d,e);a.global&&c.triggerGlobal(a,"ajaxError",[b,a,e])},handleSuccess:function(a,b,d,e){a.success&&a.success.call(a.context,e,d,b);a.global&&c.triggerGlobal(a,"ajaxSuccess",
[b,a])},handleComplete:function(a,b,d){a.complete&&a.complete.call(a.context,b,d);a.global&&c.triggerGlobal(a,"ajaxComplete",[b,a]);a.global&&c.active--===1&&c.event.trigger("ajaxStop")},triggerGlobal:function(a,b,d){(a.context&&a.context.url==null?c(a.context):c.event).trigger(b,d)},httpSuccess:function(a){try{return!a.status&&location.protocol==="file:"||a.status>=200&&a.status<300||a.status===304||a.status===1223}catch(b){}return false},httpNotModified:function(a,b){var d=a.getResponseHeader("Last-Modified"),
e=a.getResponseHeader("Etag");if(d)c.lastModified[b]=d;if(e)c.etag[b]=e;return a.status===304},httpData:function(a,b,d){var e=a.getResponseHeader("content-type")||"",f=b==="xml"||!b&&e.indexOf("xml")>=0;a=f?a.responseXML:a.responseText;f&&a.documentElement.nodeName==="parsererror"&&c.error("parsererror");if(d&&d.dataFilter)a=d.dataFilter(a,b);if(typeof a==="string")if(b==="json"||!b&&e.indexOf("json")>=0)a=c.parseJSON(a);else if(b==="script"||!b&&e.indexOf("javascript")>=0)c.globalEval(a);return a}});
if(E.ActiveXObject)c.ajaxSettings.xhr=function(){if(E.location.protocol!=="file:")try{return new E.XMLHttpRequest}catch(a){}try{return new E.ActiveXObject("Microsoft.XMLHTTP")}catch(b){}};c.support.ajax=!!c.ajaxSettings.xhr();var ea={},vb=/^(?:toggle|show|hide)$/,wb=/^([+\-]=)?([\d+.\-]+)(.*)$/,ba,pa=[["height","marginTop","marginBottom","paddingTop","paddingBottom"],["width","marginLeft","marginRight","paddingLeft","paddingRight"],["opacity"]];c.fn.extend({show:function(a,b,d){if(a||a===0)return this.animate(S("show",
3),a,b,d);else{d=0;for(var e=this.length;d<e;d++){a=this[d];b=a.style.display;if(!c.data(a,"olddisplay")&&b==="none")b=a.style.display="";b===""&&c.css(a,"display")==="none"&&c.data(a,"olddisplay",qa(a.nodeName))}for(d=0;d<e;d++){a=this[d];b=a.style.display;if(b===""||b==="none")a.style.display=c.data(a,"olddisplay")||""}return this}},hide:function(a,b,d){if(a||a===0)return this.animate(S("hide",3),a,b,d);else{a=0;for(b=this.length;a<b;a++){d=c.css(this[a],"display");d!=="none"&&c.data(this[a],"olddisplay",
d)}for(a=0;a<b;a++)this[a].style.display="none";return this}},_toggle:c.fn.toggle,toggle:function(a,b,d){var e=typeof a==="boolean";if(c.isFunction(a)&&c.isFunction(b))this._toggle.apply(this,arguments);else a==null||e?this.each(function(){var f=e?a:c(this).is(":hidden");c(this)[f?"show":"hide"]()}):this.animate(S("toggle",3),a,b,d);return this},fadeTo:function(a,b,d,e){return this.filter(":hidden").css("opacity",0).show().end().animate({opacity:b},a,d,e)},animate:function(a,b,d,e){var f=c.speed(b,
d,e);if(c.isEmptyObject(a))return this.each(f.complete);return this[f.queue===false?"each":"queue"](function(){var h=c.extend({},f),l,k=this.nodeType===1,o=k&&c(this).is(":hidden"),x=this;for(l in a){var r=c.camelCase(l);if(l!==r){a[r]=a[l];delete a[l];l=r}if(a[l]==="hide"&&o||a[l]==="show"&&!o)return h.complete.call(this);if(k&&(l==="height"||l==="width")){h.overflow=[this.style.overflow,this.style.overflowX,this.style.overflowY];if(c.css(this,"display")==="inline"&&c.css(this,"float")==="none")if(c.support.inlineBlockNeedsLayout)if(qa(this.nodeName)===
"inline")this.style.display="inline-block";else{this.style.display="inline";this.style.zoom=1}else this.style.display="inline-block"}if(c.isArray(a[l])){(h.specialEasing=h.specialEasing||{})[l]=a[l][1];a[l]=a[l][0]}}if(h.overflow!=null)this.style.overflow="hidden";h.curAnim=c.extend({},a);c.each(a,function(A,C){var J=new c.fx(x,h,A);if(vb.test(C))J[C==="toggle"?o?"show":"hide":C](a);else{var w=wb.exec(C),I=J.cur()||0;if(w){var L=parseFloat(w[2]),g=w[3]||"px";if(g!=="px"){c.style(x,A,(L||1)+g);I=(L||
1)/J.cur()*I;c.style(x,A,I+g)}if(w[1])L=(w[1]==="-="?-1:1)*L+I;J.custom(I,L,g)}else J.custom(I,C,"")}});return true})},stop:function(a,b){var d=c.timers;a&&this.queue([]);this.each(function(){for(var e=d.length-1;e>=0;e--)if(d[e].elem===this){b&&d[e](true);d.splice(e,1)}});b||this.dequeue();return this}});c.each({slideDown:S("show",1),slideUp:S("hide",1),slideToggle:S("toggle",1),fadeIn:{opacity:"show"},fadeOut:{opacity:"hide"},fadeToggle:{opacity:"toggle"}},function(a,b){c.fn[a]=function(d,e,f){return this.animate(b,
d,e,f)}});c.extend({speed:function(a,b,d){var e=a&&typeof a==="object"?c.extend({},a):{complete:d||!d&&b||c.isFunction(a)&&a,duration:a,easing:d&&b||b&&!c.isFunction(b)&&b};e.duration=c.fx.off?0:typeof e.duration==="number"?e.duration:e.duration in c.fx.speeds?c.fx.speeds[e.duration]:c.fx.speeds._default;e.old=e.complete;e.complete=function(){e.queue!==false&&c(this).dequeue();c.isFunction(e.old)&&e.old.call(this)};return e},easing:{linear:function(a,b,d,e){return d+e*a},swing:function(a,b,d,e){return(-Math.cos(a*
Math.PI)/2+0.5)*e+d}},timers:[],fx:function(a,b,d){this.options=b;this.elem=a;this.prop=d;if(!b.orig)b.orig={}}});c.fx.prototype={update:function(){this.options.step&&this.options.step.call(this.elem,this.now,this);(c.fx.step[this.prop]||c.fx.step._default)(this)},cur:function(){if(this.elem[this.prop]!=null&&(!this.elem.style||this.elem.style[this.prop]==null))return this.elem[this.prop];var a=parseFloat(c.css(this.elem,this.prop));return a&&a>-1E4?a:0},custom:function(a,b,d){function e(l){return f.step(l)}
var f=this,h=c.fx;this.startTime=c.now();this.start=a;this.end=b;this.unit=d||this.unit||"px";this.now=this.start;this.pos=this.state=0;e.elem=this.elem;if(e()&&c.timers.push(e)&&!ba)ba=setInterval(h.tick,h.interval)},show:function(){this.options.orig[this.prop]=c.style(this.elem,this.prop);this.options.show=true;this.custom(this.prop==="width"||this.prop==="height"?1:0,this.cur());c(this.elem).show()},hide:function(){this.options.orig[this.prop]=c.style(this.elem,this.prop);this.options.hide=true;
this.custom(this.cur(),0)},step:function(a){var b=c.now(),d=true;if(a||b>=this.options.duration+this.startTime){this.now=this.end;this.pos=this.state=1;this.update();this.options.curAnim[this.prop]=true;for(var e in this.options.curAnim)if(this.options.curAnim[e]!==true)d=false;if(d){if(this.options.overflow!=null&&!c.support.shrinkWrapBlocks){var f=this.elem,h=this.options;c.each(["","X","Y"],function(k,o){f.style["overflow"+o]=h.overflow[k]})}this.options.hide&&c(this.elem).hide();if(this.options.hide||
this.options.show)for(var l in this.options.curAnim)c.style(this.elem,l,this.options.orig[l]);this.options.complete.call(this.elem)}return false}else{a=b-this.startTime;this.state=a/this.options.duration;b=this.options.easing||(c.easing.swing?"swing":"linear");this.pos=c.easing[this.options.specialEasing&&this.options.specialEasing[this.prop]||b](this.state,a,0,1,this.options.duration);this.now=this.start+(this.end-this.start)*this.pos;this.update()}return true}};c.extend(c.fx,{tick:function(){for(var a=
c.timers,b=0;b<a.length;b++)a[b]()||a.splice(b--,1);a.length||c.fx.stop()},interval:13,stop:function(){clearInterval(ba);ba=null},speeds:{slow:600,fast:200,_default:400},step:{opacity:function(a){c.style(a.elem,"opacity",a.now)},_default:function(a){if(a.elem.style&&a.elem.style[a.prop]!=null)a.elem.style[a.prop]=(a.prop==="width"||a.prop==="height"?Math.max(0,a.now):a.now)+a.unit;else a.elem[a.prop]=a.now}}});if(c.expr&&c.expr.filters)c.expr.filters.animated=function(a){return c.grep(c.timers,function(b){return a===
b.elem}).length};var xb=/^t(?:able|d|h)$/i,Ia=/^(?:body|html)$/i;c.fn.offset="getBoundingClientRect"in t.documentElement?function(a){var b=this[0],d;if(a)return this.each(function(l){c.offset.setOffset(this,a,l)});if(!b||!b.ownerDocument)return null;if(b===b.ownerDocument.body)return c.offset.bodyOffset(b);try{d=b.getBoundingClientRect()}catch(e){}var f=b.ownerDocument,h=f.documentElement;if(!d||!c.contains(h,b))return d||{top:0,left:0};b=f.body;f=fa(f);return{top:d.top+(f.pageYOffset||c.support.boxModel&&
h.scrollTop||b.scrollTop)-(h.clientTop||b.clientTop||0),left:d.left+(f.pageXOffset||c.support.boxModel&&h.scrollLeft||b.scrollLeft)-(h.clientLeft||b.clientLeft||0)}}:function(a){var b=this[0];if(a)return this.each(function(x){c.offset.setOffset(this,a,x)});if(!b||!b.ownerDocument)return null;if(b===b.ownerDocument.body)return c.offset.bodyOffset(b);c.offset.initialize();var d,e=b.offsetParent,f=b.ownerDocument,h=f.documentElement,l=f.body;d=(f=f.defaultView)?f.getComputedStyle(b,null):b.currentStyle;
for(var k=b.offsetTop,o=b.offsetLeft;(b=b.parentNode)&&b!==l&&b!==h;){if(c.offset.supportsFixedPosition&&d.position==="fixed")break;d=f?f.getComputedStyle(b,null):b.currentStyle;k-=b.scrollTop;o-=b.scrollLeft;if(b===e){k+=b.offsetTop;o+=b.offsetLeft;if(c.offset.doesNotAddBorder&&!(c.offset.doesAddBorderForTableAndCells&&xb.test(b.nodeName))){k+=parseFloat(d.borderTopWidth)||0;o+=parseFloat(d.borderLeftWidth)||0}e=b.offsetParent}if(c.offset.subtractsBorderForOverflowNotVisible&&d.overflow!=="visible"){k+=
parseFloat(d.borderTopWidth)||0;o+=parseFloat(d.borderLeftWidth)||0}d=d}if(d.position==="relative"||d.position==="static"){k+=l.offsetTop;o+=l.offsetLeft}if(c.offset.supportsFixedPosition&&d.position==="fixed"){k+=Math.max(h.scrollTop,l.scrollTop);o+=Math.max(h.scrollLeft,l.scrollLeft)}return{top:k,left:o}};c.offset={initialize:function(){var a=t.body,b=t.createElement("div"),d,e,f,h=parseFloat(c.css(a,"marginTop"))||0;c.extend(b.style,{position:"absolute",top:0,left:0,margin:0,border:0,width:"1px",
height:"1px",visibility:"hidden"});b.innerHTML="<div style='position:absolute;top:0;left:0;margin:0;border:5px solid #000;padding:0;width:1px;height:1px;'><div></div></div><table style='position:absolute;top:0;left:0;margin:0;border:5px solid #000;padding:0;width:1px;height:1px;' cellpadding='0' cellspacing='0'><tr><td></td></tr></table>";a.insertBefore(b,a.firstChild);d=b.firstChild;e=d.firstChild;f=d.nextSibling.firstChild.firstChild;this.doesNotAddBorder=e.offsetTop!==5;this.doesAddBorderForTableAndCells=
f.offsetTop===5;e.style.position="fixed";e.style.top="20px";this.supportsFixedPosition=e.offsetTop===20||e.offsetTop===15;e.style.position=e.style.top="";d.style.overflow="hidden";d.style.position="relative";this.subtractsBorderForOverflowNotVisible=e.offsetTop===-5;this.doesNotIncludeMarginInBodyOffset=a.offsetTop!==h;a.removeChild(b);c.offset.initialize=c.noop},bodyOffset:function(a){var b=a.offsetTop,d=a.offsetLeft;c.offset.initialize();if(c.offset.doesNotIncludeMarginInBodyOffset){b+=parseFloat(c.css(a,
"marginTop"))||0;d+=parseFloat(c.css(a,"marginLeft"))||0}return{top:b,left:d}},setOffset:function(a,b,d){var e=c.css(a,"position");if(e==="static")a.style.position="relative";var f=c(a),h=f.offset(),l=c.css(a,"top"),k=c.css(a,"left"),o=e==="absolute"&&c.inArray("auto",[l,k])>-1;e={};var x={};if(o)x=f.position();l=o?x.top:parseInt(l,10)||0;k=o?x.left:parseInt(k,10)||0;if(c.isFunction(b))b=b.call(a,d,h);if(b.top!=null)e.top=b.top-h.top+l;if(b.left!=null)e.left=b.left-h.left+k;"using"in b?b.using.call(a,
e):f.css(e)}};c.fn.extend({position:function(){if(!this[0])return null;var a=this[0],b=this.offsetParent(),d=this.offset(),e=Ia.test(b[0].nodeName)?{top:0,left:0}:b.offset();d.top-=parseFloat(c.css(a,"marginTop"))||0;d.left-=parseFloat(c.css(a,"marginLeft"))||0;e.top+=parseFloat(c.css(b[0],"borderTopWidth"))||0;e.left+=parseFloat(c.css(b[0],"borderLeftWidth"))||0;return{top:d.top-e.top,left:d.left-e.left}},offsetParent:function(){return this.map(function(){for(var a=this.offsetParent||t.body;a&&!Ia.test(a.nodeName)&&
c.css(a,"position")==="static";)a=a.offsetParent;return a})}});c.each(["Left","Top"],function(a,b){var d="scroll"+b;c.fn[d]=function(e){var f=this[0],h;if(!f)return null;if(e!==B)return this.each(function(){if(h=fa(this))h.scrollTo(!a?e:c(h).scrollLeft(),a?e:c(h).scrollTop());else this[d]=e});else return(h=fa(f))?"pageXOffset"in h?h[a?"pageYOffset":"pageXOffset"]:c.support.boxModel&&h.document.documentElement[d]||h.document.body[d]:f[d]}});c.each(["Height","Width"],function(a,b){var d=b.toLowerCase();
c.fn["inner"+b]=function(){return this[0]?parseFloat(c.css(this[0],d,"padding")):null};c.fn["outer"+b]=function(e){return this[0]?parseFloat(c.css(this[0],d,e?"margin":"border")):null};c.fn[d]=function(e){var f=this[0];if(!f)return e==null?null:this;if(c.isFunction(e))return this.each(function(l){var k=c(this);k[d](e.call(this,l,k[d]()))});if(c.isWindow(f))return f.document.compatMode==="CSS1Compat"&&f.document.documentElement["client"+b]||f.document.body["client"+b];else if(f.nodeType===9)return Math.max(f.documentElement["client"+
b],f.body["scroll"+b],f.documentElement["scroll"+b],f.body["offset"+b],f.documentElement["offset"+b]);else if(e===B){f=c.css(f,d);var h=parseFloat(f);return c.isNaN(h)?f:h}else return this.css(d,typeof e==="string"?e:e+"px")}})})(window);


