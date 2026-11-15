<?php

declare(strict_types=1);

require_once __DIR__ . '/ClassLoader.php';
require_once __DIR__ . '/EnvLoader.php';

final class DependencyInjection
{
    public static function boot(): void
    {
        EnvLoader::load(dirname(__DIR__) . '/.env');
        ClassLoader::register();
    }

    public static function getConnection(): Connection
    {
        ClassLoader::loadClass('Connection');

        return new Connection(
            host: EnvLoader::get('DB_HOST', '127.0.0.1'),
            port: EnvLoader::getInt('DB_PORT', 3306),
            database: EnvLoader::get('DB_DATABASE', 'crud_usuarios'),
            username: EnvLoader::get('DB_USERNAME', 'root'),
            password: EnvLoader::get('DB_PASSWORD', ''),
            charset: EnvLoader::get('DB_CHARSET', 'utf8mb4')
        );
    }

    public static function getPdo(): PDO
    {
        return self::getConnection()->createPdo();
    }

    public static function getUserPersistenceMapper(): UserPersistenceMapper
    {
        ClassLoader::loadClass('UserPersistenceMapper');

        return new UserPersistenceMapper();
    }

    public static function getUserRepository(): UserRepositoryMySQL
    {
        ClassLoader::loadClass('UserRepositoryMySQL');

        return new UserRepositoryMySQL(
            self::getPdo(),
            self::getUserPersistenceMapper()
        );
    }

    public static function getEmailSenderService(): EmailSenderService
    {
        ClassLoader::loadClass('EmailSenderService');

        return new EmailSenderService(
            host: EnvLoader::get('SMTP_HOST', 'smtp.gmail.com'),
            username: EnvLoader::get('SMTP_USERNAME', ''),
            password: EnvLoader::get('SMTP_PASSWORD', ''),
            fromAddress: EnvLoader::get('SMTP_FROM_ADDRESS', ''),
            fromName: EnvLoader::get('SMTP_FROM_NAME', 'CRUD Usuarios'),
            encryption: EnvLoader::get('SMTP_ENCRYPTION', 'tls'),
            port: EnvLoader::getInt('SMTP_PORT', 587)
        );
    }

    public static function getEmailNotificationService(): EmailNotificationService
    {
        ClassLoader::loadClass('EmailNotificationService');

        return new EmailNotificationService(
            self::getEmailSenderService()
        );
    }

    public static function getCreateUserUseCase(): CreateUserUseCase
    {
        ClassLoader::loadClass('CreateUserService');
        $repository = self::getUserRepository();

        return new CreateUserService(
            $repository,
            $repository,
            self::getEmailNotificationService()
        );
    }

    public static function getUpdateUserUseCase(): UpdateUserUseCase
    {
        ClassLoader::loadClass('UpdateUserService');
        $repository = self::getUserRepository();

        return new UpdateUserService(
            $repository,
            $repository,
            $repository,
            self::getEmailNotificationService()
        );
    }

    public static function getGetUserByIdUseCase(): GetUserByIdUseCase
    {
        ClassLoader::loadClass('GetUserByIdService');

        return new GetUserByIdService(
            self::getUserRepository()
        );
    }

    public static function getGetAllUsersUseCase(): GetAllUsersUseCase
    {
        ClassLoader::loadClass('GetAllUsersService');

        return new GetAllUsersService(
            self::getUserRepository()
        );
    }

    public static function getDeleteUserUseCase(): DeleteUserUseCase
    {
        ClassLoader::loadClass('DeleteUserService');
        $repository = self::getUserRepository();

        return new DeleteUserService(
            $repository,
            $repository
        );
    }

    public static function getUserWebMapper(): UserWebMapper
    {
        ClassLoader::loadClass('UserWebMapper');

        return new UserWebMapper();
    }

    public static function getUserController(): UserController
    {
        ClassLoader::loadClass('UserController');

        return new UserController(
            self::getCreateUserUseCase(),
            self::getUpdateUserUseCase(),
            self::getGetUserByIdUseCase(),
            self::getGetAllUsersUseCase(),
            self::getDeleteUserUseCase(),
            self::getUserWebMapper()
        );
    }

    public static function getLoginUseCase(): LoginUseCase
    {
        ClassLoader::loadClass('LoginService');

        return new LoginService(
            self::getUserRepository()
        );
    }

    // ------------------------------------------------------------------
    // Municipio
    // ------------------------------------------------------------------

    public static function getMunicipioPersistenceMapper(): MunicipioPersistenceMapper
    {
        ClassLoader::loadClass('MunicipioPersistenceMapper');

        return new MunicipioPersistenceMapper();
    }

    public static function getMunicipioRepository(): MunicipioRepositoryMySQL
    {
        ClassLoader::loadClass('MunicipioRepositoryMySQL');

        return new MunicipioRepositoryMySQL(
            self::getPdo(),
            self::getMunicipioPersistenceMapper()
        );
    }

    public static function getCreateMunicipioUseCase(): CreateMunicipioUseCase
    {
        ClassLoader::loadClass('CreateMunicipioService');

        return new CreateMunicipioService(
            self::getMunicipioRepository()
        );
    }

    public static function getUpdateMunicipioUseCase(): UpdateMunicipioUseCase
    {
        ClassLoader::loadClass('UpdateMunicipioService');
        $repository = self::getMunicipioRepository();

        return new UpdateMunicipioService(
            $repository,
            $repository
        );
    }

    public static function getGetMunicipioByIdUseCase(): GetMunicipioByIdUseCase
    {
        ClassLoader::loadClass('GetMunicipioByIdService');

        return new GetMunicipioByIdService(
            self::getMunicipioRepository()
        );
    }

    public static function getGetAllMunicipiosUseCase(): GetAllMunicipiosUseCase
    {
        ClassLoader::loadClass('GetAllMunicipiosService');

        return new GetAllMunicipiosService(
            self::getMunicipioRepository()
        );
    }

    public static function getDeleteMunicipioUseCase(): DeleteMunicipioUseCase
    {
        ClassLoader::loadClass('DeleteMunicipioService');
        $repository = self::getMunicipioRepository();

        return new DeleteMunicipioService(
            $repository,
            $repository
        );
    }

    public static function getMunicipioWebMapper(): MunicipioWebMapper
    {
        ClassLoader::loadClass('MunicipioWebMapper');

        return new MunicipioWebMapper();
    }

    public static function getMunicipioController(): MunicipioController
    {
        ClassLoader::loadClass('MunicipioController');

        return new MunicipioController(
            self::getCreateMunicipioUseCase(),
            self::getUpdateMunicipioUseCase(),
            self::getGetMunicipioByIdUseCase(),
            self::getGetAllMunicipiosUseCase(),
            self::getDeleteMunicipioUseCase(),
            self::getMunicipioWebMapper()
        );
    }
}
