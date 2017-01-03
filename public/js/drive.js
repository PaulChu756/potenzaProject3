// populate people/states, also person/visit form submit
$(document).ready(function(){
	zendPopulatePeople();
	zendPopulateStates();
	displayData();
	$("#personForm")[0].reset();
	$("#visitForm")[0].reset();

	$('#addPersonSubmit').click(function(e){
		e.preventDefault();
			addPerson();
			$("#personForm")[0].reset();
	});

	$('#addVisitSubmit').click(function(e){
		e.preventDefault();
			addVisit();
			$("#visitForm")[0].reset();
	});
});

// display People Data
function displayData()
{
	$("#SelectHumanDropDown").change(function(){
		var selectedPerson = $("#SelectHumanDropDown").val();
		$.ajax({
			type: "GET",
			url: "api/people/" + selectedPerson,
			dataType: "json",
			success: function(data)
			{
				$("#PeopleInfo").empty();
				$("#VisitsInfo").empty();

				var dataLength = data.length;
				console.log(data);
				
				if(dataLength > 0)
				{
					var firstName = data[0]["firstname"];
					var lastName = data[0]["lastname"];
					var food = data[0]["food"];
					
					$("#PeopleInfo").append(
					"First name: " + firstName +
					"<br> Last name: " + lastName +
					"<br> Favorite food: " + food);

					for(var i = 0; i < dataLength; i++)
					{
						var stateName = data[i]["statename"];
						var dateVisit = data[i]["date_visited"];

						$("#VisitsInfo").append("Visited the State : " + stateName + " on " + dateVisit + "<br>");
					}
				}
				else
				{
					$.ajax({
						type:"GET",
						url: "api/people/" + selectPerson,
						dataType: "json",
						success: function(data)
						{
							$("#PeopleInfo").empty();
							$("#VisitsInfo").empty();

							var firstName = data[0]["firstname"];
							var lastName = data[0]["lastname"];
							var food = data[0]["food"];

							$("#displayPeopleInfo").append(
							"First name: " + firstName +
							"<br> Last name: " + lastName +
							"<br> Favorite food: " + food +
							"<br> has never traveled in their life.");
						}
					});
				}
			}
		});
	});
}

//populate zendPeople's dropdowns
function zendPopulatePeople()
{
	$.ajax({
		type:"GET",
		url:"api/people",
		dataType:"json",
		success : function(data)
		{
			$("#SelectHumanDropDown option").not("#personOptions").remove();
			$("#humanNameDropDown option").not("#personOptions").remove();

			$.each(data, function(i,item)
			{
				$("#SelectHumanDropDown").append("<option value='" + data[i].id + "'>" + data[i].firstname + "</option>");
				$("#humanNameDropDown").append("<option value='" + data[i].id + "'>" + data[i].firstname + "</option>");
			});
		},
		error : function(data)
		{
			console.log('Error: to populate people');
			console.log(data);
		}
	});
}

//populate zendState's dropdown
function zendPopulateStates()
{
	$.ajax({
		type:"GET",
		url:"api/states",
		dataType:"json",
		success : function(data)
		{
			$.each(data, function(i,item)
			{
				$("#stateNameDropDown").append("<option value='" + data[i].id + "'>" + data[i].statename + "</option>");
			});
		}
	});
}

//Add person to database
function addPerson()
{
	$.ajax({
		type: "POST",
		url: "api/people",
		data: $("#personForm").serialize(),
		success: function(data)
		{
			alert("You have added a person");
			console.log(data);
			console.log($("#personForm").serialize());
			zendPopulatePeople();
			displayData();
		},
		error:function(data)
		{
			alert("Please fill out all inputs");
			console.log(data);
			console.log($("#personForm").serialize());
		}
	});
}

//Add visit to database
function addVisit()
{
	$.ajax({
		type: "POST",
		url: "api/visits",
		data: $("#visitForm").serialize(),
		success: function(data)
		{
			alert("You have added a visit");
			console.log(data);
			console.log($("#visitForm").serialize());
		},
		error: function(data)
		{
			alert("Please fill out all inputs");
			console.log(data);
			console.log($("#visitForm").serialize());
		}
	});
}
