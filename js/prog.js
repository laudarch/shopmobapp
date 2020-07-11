App = {
	load: function() {
		jo.load();

		document.body.addEventListener('touchmove', function(e) {
		    e.preventDefault();
			joEvent.stop(e);
		}, false);

		this.scn = new joScreen(
			new joContainer([
				new joFlexcol([
					this.nav = new joNavbar(),
					this.stack = new joStackScroller()
				]),
				this.toolbar = new joToolbar(
				"&copy; 2011 Origgin <sub>powered by <a href='http://qremiaevolution.org'>Qremia Evolution</a>").setStyle({font: "9px sans-serif"})
			]).setStyle({position: "absolute",
				     top: "0",
				     left: "0",
				     bottom: "0",
				     right: "0"})
		);

		this.nav.setStack(this.stack);
		this.stack.push(joCache.get("home"));

		joGesture.backEvent.subscribe(this.stack.pop, this.stack);
	}
};

joCache.set("home", function() {
	var login;
	
	// simple table with inline data
	var x = new joTable ([
	["Nickname" , "Phone", "Email" ],
	["Bob<img src='images/logo.png' align='center'/>", "555-1234", "bob@bobco.not" ],
	["Jo", "555-3456 ", "jo@joco.not" ],
	["Jane", "555-6789", "jane@janeco.not" ]
	]).setStyle({cursor: 'pointer', border: '1px solid #000'});
	// we can respond to touch events in the table
	x.selectEvent.subscribe(function (index, table) {
		// get the current row and column
		//joLog("Table cell clicked: " , table.getRow(), table.getCol());
		// you can also get at the cell HTML element as well
		//joDOM.setStyle(table.getNode(), {fontWeight: "bold"}) ;
	}) ;
	
	var card = new joCard([x]);

	var title = "<table width='100%'><tr><td align='left'><img src='images/logo.png' align='center'/></td><td align='center'>Shop Mob</td><td align='right'>login | sign up</td></tr?</table>"
	card.setTitle(title);
	
	return card;
});

joCache.set("login", function() {
	var login = [
		new joTitle("Admin Login"),
		new joGroup([
			new joCaption("User Name"),
			new joFlexrow(new joInput("")),
			new joLabel("Password"),
			new joFlexrow(new joPasswordInput(""))
		]),
		new joButton("Login").selectEvent.subscribe(pop)
	];
	
	function pop() {
		console.log("hide login box");
		App.scn.hidePopup();
	}
	
	return (login);
});
