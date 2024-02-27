open them by using postman 


base_url = php.project
users = user
end_points = [
	all_users => [
		method: GET,
		uri: 'php.project/user'
	]

	single_user => [
		method: GET,
		uri: php.project/user/{id}
	]
	soft_deleded_users => [
		method: GET,
		uri: php.project/user/deleded_users
	]
	add_single_user => [
		method: POST,
		uri: php.project/user
	]
	update_single_user => [
		method: POST,
		uri: php.project/user/{id}
	]
	restore_softdeleded_user => [
		method: PUT,
		uri: php.project/user/restore/{id}
	]
	soft_delede_user => [
		method: DELETE,
		uri: php.project/user/{id}
	]
]
