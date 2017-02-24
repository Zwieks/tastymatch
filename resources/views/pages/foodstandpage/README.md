CLICK TO SAVE
- detailpage.blade
- regel 624: //SAVE ALL THE CUSTOM TEMPLATE CONTENT
-   //Save the AGENDA FORM content
	var count = 0;
	$.each($.fn.locations_object, function(index, value) {
		console.log(value);
		console.log('end');
		if(typeof value['info'].new != 'undefined' && value['info'].new == true){
			save_components['component-agendaitems-new-'+count] = value;
			count++;
		}else if(typeof value.updateitem != 'undefined'){
			save_components['component-agendaitems-update-'+count] = value;
			count++;
		}else if(typeof value.event_id == 'undefined' && value.id == ''){
			save_components['component-agendaitems-new-'+count] = value;
			count++;
		}
	});

UPDATE/REMOVE/NEW AGENDA ITEM
- detailpage.blade	(TAG: AGENDAHANDLER)
- Form handeling when the user wants to save the agenda item	
- regel 839
- ROUTE: -->validateForm(regel:174, tag:VALIDATEFORM) 
			--> updateAgendaItemsToGlobalSaveObject(regel: 14, tag:UPDATEAGENDAGLOBALOBJECT)
