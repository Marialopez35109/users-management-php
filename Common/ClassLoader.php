<?php

declare(strict_types=1);

final class ClassLoader
{
    /**
     * @var array<string, string>
     */
    private static array $classMap = array(
        'InvalidUserEmailException' => 'Domain/Exceptions/InvalidUserEmailException.php',
        'InvalidUserIdException' => 'Domain/Exceptions/InvalidUserIdException.php',
        'InvalidUserNameException' => 'Domain/Exceptions/InvalidUserNameException.php',
        'InvalidUserPasswordException' => 'Domain/Exceptions/InvalidUserPasswordException.php',
        'InvalidUserRoleException' => 'Domain/Exceptions/InvalidUserRoleException.php',
        'InvalidUserStatusException' => 'Domain/Exceptions/InvalidUserStatusException.php',
        'UserAlreadyExistsException' => 'Domain/Exceptions/UserAlreadyExistsException.php',
        'UserNotFoundException' => 'Domain/Exceptions/UserNotFoundException.php',
        'InvalidCredentialsException' => 'Domain/Exceptions/InvalidCredentialsException.php',

        'UserRoleEnum' => 'Domain/Enums/UserRoleEnum.php',
        'UserStatusEnum' => 'Domain/Enums/UserStatusEnum.php',

        'UserId' => 'Domain/ValueObjects/UserId.php',
        'UserName' => 'Domain/ValueObjects/UserName.php',
        'UserEmail' => 'Domain/ValueObjects/UserEmail.php',
        'UserPassword' => 'Domain/ValueObjects/UserPassword.php',

        'UserModel' => 'Domain/Models/UserModel.php',
        'EmailDestinationModel' => 'Domain/Models/EmailDestinationModel.php',
        'EmailSenderException' => 'Domain/Exceptions/EmailSenderException.php',
        'EmailSenderPort' => 'Application/Ports/Out/EmailSenderPort.php',
        'EmailNotificationService' => 'Application/Services/EmailNotificationService.php',
        'EmailSenderService' => 'Infrastructure/Adapters/Email/EmailSenderService.php',

        'CreateUserUseCase' => 'Application/Ports/In/CreateUserUseCase.php',
        'UpdateUserUseCase' => 'Application/Ports/In/UpdateUserUseCase.php',
        'GetUserByIdUseCase' => 'Application/Ports/In/GetUserByIdUseCase.php',
        'GetAllUsersUseCase' => 'Application/Ports/In/GetAllUsersUseCase.php',
        'DeleteUserUseCase' => 'Application/Ports/In/DeleteUserUseCase.php',
        'LoginUseCase' => 'Application/Ports/In/LoginUseCase.php',

        'SaveUserPort' => 'Application/Ports/Out/SaveUserPort.php',
        'UpdateUserPort' => 'Application/Ports/Out/UpdateUserPort.php',
        'GetUserByIdPort' => 'Application/Ports/Out/GetUserByIdPort.php',
        'GetUserByEmailPort' => 'Application/Ports/Out/GetUserByEmailPort.php',
        'GetAllUsersPort' => 'Application/Ports/Out/GetAllUsersPort.php',
        'DeleteUserPort' => 'Application/Ports/Out/DeleteUserPort.php',

        'CreateUserCommand' => 'Application/Services/Dto/Commands/CreateUserCommand.php',
        'UpdateUserCommand' => 'Application/Services/Dto/Commands/UpdateUserCommand.php',
        'DeleteUserCommand' => 'Application/Services/Dto/Commands/DeleteUserCommand.php',
        'LoginCommand' => 'Application/Services/Dto/Commands/LoginCommand.php',
        'GetUserByIdQuery' => 'Application/Services/Dto/Queries/GetUserByIdQuery.php',
        'GetAllUsersQuery' => 'Application/Services/Dto/Queries/GetAllUsersQuery.php',

        'CreateUserService' => 'Application/Services/CreateUserService.php',
        'UpdateUserService' => 'Application/Services/UpdateUserService.php',
        'GetUserByIdService' => 'Application/Services/GetUserByIdService.php',
        'GetAllUsersService' => 'Application/Services/GetAllUsersService.php',
        'DeleteUserService' => 'Application/Services/DeleteUserService.php',
        'LoginService' => 'Application/Services/LoginService.php',
        'UserApplicationMapper' => 'Application/Services/Mappers/UserApplicationMapper.php',

        'Connection' => 'Infrastructure/Adapters/Persistence/MySQL/Config/Connection.php',
        'UserPersistenceDto' => 'Infrastructure/Adapters/Persistence/MySQL/Dto/UserPersistenceDto.php',
        'UserEntity' => 'Infrastructure/Adapters/Persistence/MySQL/Entity/UserEntity.php',
        'UserPersistenceMapper' => 'Infrastructure/Adapters/Persistence/MySQL/Mapper/UserPersistenceMapper.php',
        'UserRepositoryMySQL' => 'Infrastructure/Adapters/Persistence/MySQL/Repository/UserRepositoryMySQL.php',

        'CreateUserWebRequest' => 'Infrastructure/Entrypoints/Web/Controllers/Dto/CreateUserRequest.php',
        'UpdateUserWebRequest' => 'Infrastructure/Entrypoints/Web/Controllers/Dto/UpdateUserRequest.php',
        'LoginWebRequest' => 'Infrastructure/Entrypoints/Web/Controllers/Dto/LoginWebRequest.php',
        'UserResponse' => 'Infrastructure/Entrypoints/Web/Controllers/Dto/UserResponse.php',
        'UserWebMapper' => 'Infrastructure/Entrypoints/Web/Controllers/Mapper/UserWebMapper.php',
        'UserController' => 'Infrastructure/Entrypoints/Web/Controllers/UserController.php',
        'WebRoutes' => 'Infrastructure/Entrypoints/Web/Controllers/Config/WebRoutes.php',

        'View' => 'Infrastructure/Entrypoints/Web/Presentation/View.php',
        'Flash' => 'Infrastructure/Entrypoints/Web/Presentation/Flash.php',

        'DependencyInjection' => 'Common/DependencyInjection.php',

        // ---------------- Municipio ----------------
        'InvalidMunicipioIdException' => 'Domain/Exceptions/InvalidMunicipioIdException.php',
        'InvalidMunicipioNameException' => 'Domain/Exceptions/InvalidMunicipioNameException.php',
        'InvalidMunicipioDataException' => 'Domain/Exceptions/InvalidMunicipioDataException.php',
        'MunicipioNotFoundException' => 'Domain/Exceptions/MunicipioNotFoundException.php',

        'MunicipioId' => 'Domain/ValueObjects/MunicipioId.php',
        'MunicipioName' => 'Domain/ValueObjects/MunicipioName.php',
        'MunicipioModel' => 'Domain/Models/MunicipioModel.php',

        'CreateMunicipioUseCase' => 'Application/Ports/In/CreateMunicipioUseCase.php',
        'UpdateMunicipioUseCase' => 'Application/Ports/In/UpdateMunicipioUseCase.php',
        'GetMunicipioByIdUseCase' => 'Application/Ports/In/GetMunicipioByIdUseCase.php',
        'GetAllMunicipiosUseCase' => 'Application/Ports/In/GetAllMunicipiosUseCase.php',
        'DeleteMunicipioUseCase' => 'Application/Ports/In/DeleteMunicipioUseCase.php',

        'SaveMunicipioPort' => 'Application/Ports/Out/SaveMunicipioPort.php',
        'UpdateMunicipioPort' => 'Application/Ports/Out/UpdateMunicipioPort.php',
        'GetMunicipioByIdPort' => 'Application/Ports/Out/GetMunicipioByIdPort.php',
        'GetAllMunicipiosPort' => 'Application/Ports/Out/GetAllMunicipiosPort.php',
        'DeleteMunicipioPort' => 'Application/Ports/Out/DeleteMunicipioPort.php',

        'CreateMunicipioCommand' => 'Application/Services/Dto/Commands/CreateMunicipioCommand.php',
        'UpdateMunicipioCommand' => 'Application/Services/Dto/Commands/UpdateMunicipioCommand.php',
        'DeleteMunicipioCommand' => 'Application/Services/Dto/Commands/DeleteMunicipioCommand.php',
        'GetMunicipioByIdQuery' => 'Application/Services/Dto/Queries/GetMunicipioByIdQuery.php',
        'GetAllMunicipiosQuery' => 'Application/Services/Dto/Queries/GetAllMunicipiosQuery.php',

        'CreateMunicipioService' => 'Application/Services/CreateMunicipioService.php',
        'UpdateMunicipioService' => 'Application/Services/UpdateMunicipioService.php',
        'GetMunicipioByIdService' => 'Application/Services/GetMunicipioByIdService.php',
        'GetAllMunicipiosService' => 'Application/Services/GetAllMunicipiosService.php',
        'DeleteMunicipioService' => 'Application/Services/DeleteMunicipioService.php',
        'MunicipioApplicationMapper' => 'Application/Services/Mappers/MunicipioApplicationMapper.php',

        'MunicipioPersistenceDto' => 'Infrastructure/Adapters/Persistence/MySQL/Dto/MunicipioPersistenceDto.php',
        'MunicipioEntity' => 'Infrastructure/Adapters/Persistence/MySQL/Entity/MunicipioEntity.php',
        'MunicipioPersistenceMapper' => 'Infrastructure/Adapters/Persistence/MySQL/Mapper/MunicipioPersistenceMapper.php',
        'MunicipioRepositoryMySQL' => 'Infrastructure/Adapters/Persistence/MySQL/Repository/MunicipioRepositoryMySQL.php',

        'CreateMunicipioWebRequest' => 'Infrastructure/Entrypoints/Web/Controllers/Dto/CreateMunicipioRequest.php',
        'UpdateMunicipioWebRequest' => 'Infrastructure/Entrypoints/Web/Controllers/Dto/UpdateMunicipioRequest.php',
        'MunicipioResponse' => 'Infrastructure/Entrypoints/Web/Controllers/Dto/MunicipioResponse.php',
        'MunicipioWebMapper' => 'Infrastructure/Entrypoints/Web/Controllers/Mapper/MunicipioWebMapper.php',
        'MunicipioController' => 'Infrastructure/Entrypoints/Web/Controllers/MunicipioController.php',
    );

    public static function register(): void
    {
        spl_autoload_register(array(self::class, 'loadClass'));
    }

    public static function loadClass(string $className): void
    {
        if (!isset(self::$classMap[$className])) {
            return;
        }

        $baseDir = dirname(__DIR__) . DIRECTORY_SEPARATOR;
        $filePath = $baseDir . self::$classMap[$className];

        if (!file_exists($filePath)) {
            throw new RuntimeException(
                sprintf('No se encontró el archivo para la clase %s en %s', $className, $filePath)
            );
        }

        require_once $filePath;
    }
}
