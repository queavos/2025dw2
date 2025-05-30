<?php
class Paginacion {
    private $conex;
    private $tabla;
    public $paginaActual;
    private $registrosPorPagina;
    public $totalRegistros;
    public $totalPaginas;
    private $error;

    public function __construct(mysqli $conex, string $tabla, int $paginaActual = 1, int $registrosPorPagina = 10) {
        $this->conex = $conex;
        $this->tabla = $tabla;
        $this->paginaActual = max(1, $paginaActual); // Asegura que la página actual sea al menos 1
        $this->registrosPorPagina = $registrosPorPagina; // Asegura que los registros por página sean al menos 1
    }

    public function totalPaginas() {
        $sql= "SELECT COUNT(*) AS total FROM {$this->tabla}";
        $resultado = $this->conex->query($sql);
        if ($resultado) {
            $fila = $resultado->fetch_assoc();
            $this->totalRegistros = $fila['total'];
        } else {
            $this->error = "Error al obtener el total de registros: " . $this->conex->error;
            return 0; // Retorna 0 si hay un error
        }
        $this->totalPaginas = ceil($this->totalRegistros / $this->registrosPorPagina);
        return $this->totalPaginas;
        // return ceil($this->totalRegistros / $this->registrosPorPagina);
    }
    public function obtenerDatos() {
        $offset = ($this->paginaActual - 1) * $this->registrosPorPagina;
        $sql = "SELECT * FROM {$this->tabla} LIMIT {$this->registrosPorPagina} OFFSET {$offset}";
        $resultado = $this->conex->query($sql);
        if ($resultado) {
            return $resultado;
        } else {
            $this->error = "Error al obtener los datos: " . $this->conex->error;
            return [];
        }
    }
    public function mostrarBarrasNavegacion() 
    {
        
        $totalPaginas = $this->totalPaginas();
        if ($totalPaginas <= 1) {
            return ''; // No hay barras de navegación si solo hay una página
        }       
        $barras = '<nav aria-label="Page navigation"><ul class="pagination">';
        // Botón de página anterior                 
        if ($this->paginaActual > 1) {
            $barras .= '<li class="page-item"><a class="page-link" href="index.php?pagina=' . ($this->paginaActual - 1) . '">Anterior</a></li>';
        } else {
            $barras .= '<li class="page-item disabled"><span class="page-link">Anterior</span></li>';
        }
        // Botones de páginas       
        for ($i = 1; $i <= $totalPaginas; $i++) {
            if ($i == $this->paginaActual) {
                $barras .= '<li class="page-item active"><span class="page-link">' . $i . '</span></li>';
            } else {
                $barras .= '<li class="page-item"><a class="page-link" href="index.php?pagina=' . $i . '">' . $i . '</a></li>';
            }
        }                                                               
        // Botón de página siguiente
        if ($this->paginaActual < $totalPaginas) {
            $barras .= '<li class="page-item"><a class="page-link" href="index.php?pagina=' . ($this->paginaActual + 1) . '">Siguiente</a></li>';
        } else {
            $barras .= '<li class="page-item disabled"><span class="page-link">Siguiente</span></li>';
        }
        $barras .= '</ul></nav>';       
        return $barras; 
    }
    }

    /*
    public function paginaAnterior() {
        return max(1, $this->paginaActual - 1);
    }

    public function paginaSiguiente() {
        return min($this->totalPaginas(), $this->paginaActual + 1);
    }*/
