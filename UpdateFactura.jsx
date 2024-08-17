import { useEffect, useState } from "react";
import { useForm, Controller } from "react-hook-form";
import { yupResolver } from "@hookform/resolvers/yup";
import * as yup from "yup";
import {
  Container,
  Paper,
  Grid,
  TextField,
  Button,
  Typography,
  FormControl,
} from "@mui/material";
import { toast } from "react-hot-toast";
import { useNavigate, useParams } from "react-router-dom";
import ProductoService from "../../services/ProductoService";
import FacturaDetalleService from "../../services/FacturaDetalleService";
import FacturaService from "../../services/FacturaService";
import SelectProducto from "./Form/SelectProducto";
import SucursalService from "../../services/SucursalService";

const facturaSchema = yup.object().shape({
  productos: yup
    .array()
    .of(
      yup.object().shape({
        producto: yup.string().required("El producto es requerido"),
        cantidad: yup
          .number()
          .required("La cantidad es requerida")
          .positive("La cantidad debe ser un número positivo"),
        precio: yup
          .number()
          .required("El precio es requerido")
          .positive("El precio debe ser un número positivo"),
        subtotal: yup
          .number()
          .required("El subtotal es requerido")
          .positive("El subtotal debe ser un número positivo"),
      })
    )
    .min(1, "Debe agregar al menos un producto"),
});

export default function UpdateFactura() {
  const navigate = useNavigate();
  const { id } = useParams();
  const [sucursal, setSucursal] = useState(null);
  const [facturaDato, setFacturaDato] = useState(null);
  const {
    control,
    handleSubmit,
    reset,
    setValue,
    watch,
    formState: { errors },
  } = useForm({
    resolver: yupResolver(facturaSchema),
    defaultValues: {
      fecha: new Date().toLocaleDateString(),
      sucursal: "Sucursal Ejemplo",
      encargado: "Encargado Ejemplo",
      productos: [{ producto: "", cantidad: 1, precio: 0, subtotal: 0 }],
    },
  });

  const [productos, setProductos] = useState([]);

  useEffect(() => {
    FacturaService.getFacturaById(Number(id))
      .then((response) => {
        const factura = response.data.results;
        SucursalService.getSucursalById(Number(factura.idSucursal))
          .then((response) => {
            setSucursal(response.data.results);
            reset({
              id: id,
              fecha: factura.Fecha,
              sucursal: response.data.results.nombre,
              encargado: factura.Encargado,
              productos: factura.productos,
            });
            setFacturaDato(factura);  // Mover esta línea aquí para asegurar que se setee facturaDato antes de usarlo
          })
          .catch((error) => {
            console.error(error);
            toast.error("Error al cargar la sucursal", {
              duration: 4000,
              position: "top-center",
            });
          });
      })
      .catch((error) => {
        console.error(error);
        toast.error("Error al cargar la factura", {
          duration: 4000,
          position: "top-center",
        });
      });
  }, [id, reset]);

  useEffect(() => {
    ProductoService.getProductos()
      .then((response) => {
        setProductos(response.data.results);
      })
      .catch((error) => {
        console.error(error);
        toast.error("Error al cargar los productos");
      });
  }, []);

  const onSubmit = (formData) => {
    if (!facturaDato) {
      toast.error("Datos de la factura no cargados correctamente");
      return;
    }

    const facturaData = {
      id: id,
      fecha: formData.fecha,
      idUsuario: facturaDato.idUsuario,
      idSucursal: sucursal.id,
      total: totalConImpuesto,
      detalles: productosWatch.map((producto) => ({
        idProducto: producto.producto,
        cantidad: producto.cantidad,
        estado: 1,
      })),
    };

    FacturaService.update(facturaData)
      .then((response) => {
        toast.success("Factura registrada exitosamente");

        const detalles = (facturaData.detalles || []).map((detalle) => ({
          idFactura: response.data.id,
          ...detalle,
        }));

        return Promise.all(
          detalles.map((detalle) =>
            FacturaDetalleService.create(detalle).catch((error) => {
              console.error(error);
            })
          )
        );
      })
      .then(() => {
        navigate("/factura");
      })
      .catch((error) => {
        console.error(error);
        toast.error("Error al registrar la factura");
      });
  };

  const productosWatch = watch("productos", []);

  const handleProductoChange = (index, productoId) => {
    ProductoService.getProductoById(productoId)
      .then((response) => {
        const producto = response.data.results;
        setValue(`productos.${index}.precio`, producto.Precio);
        setValue(
          `productos.${index}.subtotal`,
          producto.Precio * productosWatch[index].cantidad
        );
      })
      .catch((error) => {
        console.error(error);
        toast.error("Error al cargar el producto");
      });
  };

  const handleCantidadChange = (index, cantidad) => {
    const newCantidad = Number(cantidad) || 0;
    setValue(
      `productos.${index}.subtotal`,
      productosWatch[index].precio * newCantidad
    );
  };

  const handleAddProducto = () => {
    setValue("productos", [
      ...productosWatch,
      { producto: "", cantidad: 1, precio: 0, subtotal: 0 },
    ]);
  };

  const handleRemoveProducto = (index) => {
    const updatedProductos = productosWatch.filter((_, i) => i !== index);
    setValue("productos", updatedProductos);
  };

  const total = productosWatch.reduce(
    (acc, producto) => acc + producto.subtotal,
    0
  );
  const impuesto = total * 0.13;
  const totalConImpuesto = total + impuesto;

  return (
    <Container component="main" sx={{ mt: 8, mb: 2 }}>
      <Paper sx={{ p: 3, borderRadius: "10px", backgroundColor: "#9ca5a9" }}>
        <form onSubmit={handleSubmit(onSubmit)} noValidate>
          <Grid container spacing={2}>
            <Grid item xs={12} sm={6}>
              <FormControl variant="outlined" fullWidth>
                <Typography
                  variant="body1"
                  sx={{ color: "#000", marginBottom: "4px", fontSize: "16px" }}
                >
                  Fecha
                </Typography>
                <Controller
                  name="fecha"
                  control={control}
                  render={({ field }) => (
                    <TextField
                      {...field}
                      disabled
                      variant="outlined"
                      fullWidth
                      InputProps={{
                        style: { backgroundColor: "#fff", color: "#000" },
                      }}
                    />
                  )}
                />
              </FormControl>
            </Grid>
            <Grid item xs={12} sm={6}>
              <FormControl variant="outlined" fullWidth>
                <Typography
                  variant="body1"
                  sx={{ color: "#000", marginBottom: "4px", fontSize: "16px" }}
                >
                  Sucursal
                </Typography>
                <Controller
                  name="sucursal"
                  control={control}
                  render={({ field }) => (
                    <TextField
                      {...field}
                      disabled
                      variant="outlined"
                      fullWidth
                      InputProps={{
                        style: { backgroundColor: "#fff", color: "#000" },
                      }}
                    />
                  )}
                />
              </FormControl>
            </Grid>

            <Grid item xs={12}>
              <Typography
                variant="h6"
                component="h2"
                sx={{ color: "#000", marginBottom: "8px" }}
              >
                Detalles de la Factura
              </Typography>
              {productosWatch.map((producto, index) => (
                <Grid
                  container
                  spacing={2}
                  key={index}
                  sx={{
                    backgroundColor: "#f5f5f5",
                    marginBottom: "16px",
                    padding: "16px",
                    borderRadius: "8px",
                  }}
                >
                  <Grid item xs={12} sm={4}>
                    <Controller
                      name={`productos.${index}.producto`}
                      control={control}
                      render={({ field }) => (
                        <SelectProducto
                          field={field}
                          data={productos}
                          error={Boolean(errors?.productos?.[index]?.producto)}
                          helperText={
                            errors?.productos?.[index]?.producto?.message
                          }
                          onChange={(e) => {
                            handleProductoChange(index, e.target.value);
                            field.onChange(e); 
                          }}
                        />
                      )}
                    />
                  </Grid>
                  <Grid item xs={12} sm={2}>
                    <Controller
                      name={`productos.${index}.cantidad`}
                      control={control}
                      render={({ field }) => (
                        <TextField
                          {...field}
                          variant="outlined"
                          fullWidth
                          type="number"
                          error={Boolean(errors?.productos?.[index]?.cantidad)}
                          helperText={
                            errors?.productos?.[index]?.cantidad?.message
                          }
                          InputProps={{
                            style: { backgroundColor: "#fff", color: "#000" },
                          }}
                          onChange={(e) => {
                            handleCantidadChange(index, e.target.value);
                            field.onChange(e);
                          }}
                        />
                      )}
                    />
                  </Grid>
                  <Grid item xs={12} sm={3}>
                    <Controller
                      name={`productos.${index}.precio`}
                      control={control}
                      render={({ field }) => (
                        <TextField
                          {...field}
                          disabled
                          variant="outlined"
                          fullWidth
                          error={Boolean(errors?.productos?.[index]?.precio)}
                          helperText={
                            errors?.productos?.[index]?.precio?.message
                          }
                          InputProps={{
                            style: { backgroundColor: "#fff", color: "#000" },
                          }}
                        />
                      )}
                    />
                  </Grid>
                  <Grid item xs={12} sm={3}>
                    <Controller
                      name={`productos.${index}.subtotal`}
                      control={control}
                      render={({ field }) => (
                        <TextField
                          {...field}
                          disabled
                          variant="outlined"
                          fullWidth
                          error={Boolean(errors?.productos?.[index]?.subtotal)}
                          helperText={
                            errors?.productos?.[index]?.subtotal?.message
                          }
                          InputProps={{
                            style: { backgroundColor: "#fff", color: "#000" },
                          }}
                        />
                      )}
                    />
                  </Grid>
                  <Grid item xs={12} sm={12}>
                    <Button
                      onClick={() => handleRemoveProducto(index)}
                      color="error"
                      variant="contained"
                    >
                      Eliminar Producto
                    </Button>
                  </Grid>
                </Grid>
              ))}
              <Button
                onClick={handleAddProducto}
                color="primary"
                variant="contained"
              >
                Agregar Producto
              </Button>
            </Grid>
            <Grid item xs={12}>
              <Typography
                variant="h6"
                sx={{ color: "#000", marginTop: "16px", fontSize: "20px" }}
              >
                Total sin Impuesto: {total.toFixed(2)}
              </Typography>
              <Typography
                variant="h6"
                sx={{ color: "#000", marginTop: "8px", fontSize: "20px" }}
              >
                Impuesto: {impuesto.toFixed(2)}
              </Typography>
              <Typography
                variant="h6"
                sx={{ color: "#000", marginTop: "8px", fontSize: "20px" }}
              >
                Total con Impuesto: {totalConImpuesto.toFixed(2)}
              </Typography>
            </Grid>
          </Grid>
          <Button
            type="submit"
            fullWidth
            variant="contained"
            color="primary"
            sx={{ mt: 3 }}
          >
            Registrar Factura
          </Button>
        </form>
      </Paper>
    </Container>
  );
}
