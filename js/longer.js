LongerUrl = function(content, options) {
	this.init(content, options);
};

LongerUrl.prototype = {
	level : 0,
	snippets: [],
	longurl: '',
	originalurl : 'http://www.youtube.com/watch?v=YgXieZTHqq8',
	
	defaults : {
		'originalUrl' : 'http://www.youtube.com/watch?v=YgXieZTHqq8',
	},
		
	init: function(element, options) {
		var self = this;
		this.options = jQuery.extend({}, this.defaults, options);
		this.element = element;	
		this.setupDefaults(element);
		this.setupEvents(element);
	},
	
	setupDefaults : function(element) {
		for (var att in this.defaults) {
			this.element.find("#"+att).val(this.defaults[att]).addClass('italic');
		} 
	},
	
	setupEvents : function(element) {
		var self = this;
		element.delegate('input', 'click', function(){
			if (this.type=="text") {
				self.handleMouseClick(this.id);
			}
		});
		
		element.delegate('form', 'submit', function(){
			self.handleFormSubmit();
			return false;
		});
		
		element.delegate('#submit', 'click', function(){
			self.handleFormSubmit();
			return false;
		});
		
		element.delegate('.report-link', 'click', function(){
			self.handleErrorReport(this.href);
			return false;
		});
		
		element.delegate('input', 'blur', function() {
			self.handleBlur(this.id);
		});
		
		element.delegate('input', 'mouseover', function(){
			self.handleMouseOver(this.id);
		});
		
		element.delegate('input', 'mouseout', function(){
			self.handleMouseOut(this.id);
		});
	},
	
	handleMouseClick : function(id) {
		var elm = this.element.find("#"+id);
		elm.removeClass("italic");
		var val = elm.val();
		if (val == this.defaults[id]) {
			elm.val("");
		} else if (elm.hasClass("click_select")){
			elm.select();
		}
		return false;
	},
	
	handleMouseOver : function(id) {
		this.element.find("#"+id).addClass("hover");
	},
	
	handleMouseOut : function(id) {
		this.element.find("#"+id).removeClass("hover");
	},
	
	handleBlur : function(id) {
		var elm = this.element.find("#"+id);
		var val = elm.val();
		if (val == "" && !elm.hasClass("click_select")) {
			elm.val(this.defaults[id]);
			elm.addClass("italic");
		} else if (id == 'originalUrl' && val != this.originalurl) {
			this.reset();
		}
	},
	
	handleErrorReport : function(url) {
		var urlParts = url.split('/');
		var key = urlParts[3];
		$.ajax({
			url: '/ajax/report/',
			dataType: 'html',
			type: 'POSTT',
			data: 'key='+key,
			success: function(data){
				$('.report-link[href='+url+']').replaceWith("Thx. I'll take a look when I have a  minute");
			},
			error: function(){
				
			}
		});
	},
	
	handleFormSubmit : function() {
		var self = this;
		if (this.level == 0) {
			var url = $('#originalUrl').val();
			this.originalurl = url;
			if (url.length > 4) {
				if(url.indexOf('http') < 0) {
					url = 'http://' + url;
					$('#originalUrl').val(url);
				}
			}
			$("#loading").show();
			$.ajax({
				url: '/ajax/getlongerurls/',
				dataType: 'json',
				type: 'POST',
				data: this.element.find('form').serialize(),
				success: function(data){
					self.snippets = data['snippets'];
					$("#loading").hide();
					if (self.snippets.length > 0) {
						self.longurl += data['hash'] + '/' + self.snippets[0];
						self.displayBlock(data['hash'] + '/' + self.snippets[0]);
						if (self.snippets.length-1 == self.level) {
							$("#submit").hide();
						}
						self.level++;
					} else {
						if (data['errormsg'].length > 0) {
							self.displayError(data['errormsg']);
						} else{
							self.displayError('an unexpected error occurred');
						}
					}
				},
				error: function(){
					$("#loading").hide();
				}
			});
		} else {
			
			if (this.snippets.length-1 == this.level) {
				$("#submit").hide();
			}
			this.longurl += '/'+this.snippets[this.level];
			this.displayBlock(this.longurl);
			this.level++;
		}
		
		
		return false;
	},
	
	reset: function(){
		$("#submit").show();
		this.level = 0;
		this.longurl = '';
		this.snippets = [];
		$("#result").html("");
	},
	
	displayBlock : function(url) {
		$('#test').html("<span id='test-content' style='white-space: nowrap'>http://longerURLs/"+url+"</span>");
		var width = $("#test-content").width() + 100;
		var self = this;
		var result = '<div class="actual" style="width:'+(width+10)+'px;margin-top:30px;padding-bottom:10px;">' +
			'<label>Here\'s your  long URL:</label> <input id="result-'+this.level+'" class="click_select" type="text" style="width:'+width+'px;" value="http://longerURLs.com/'+url+'" />' +
			'<div class="report" id="report-'+this.level+'"><a href="http://longerurls/'+url+'" class="report-link" id="report-link-'+this.level+'">It didn\'t  work? Report</a></div>' +
		'</div>';
		self.element.find('#result').append(result);
	},
	
	displayError: function(msg) {
	
		var result = '<div class="error">'+msg+'</div>';
		this.element.find('#result').append(result);
	}
};